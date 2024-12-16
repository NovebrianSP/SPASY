<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subs extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Subscription_model');
    $this->load->library('session');
  }

  // Fungsi untuk memproses pembayaran
  public function pay_subscription($package)
  {
    // Paket langganan dan durasi
    $packages = [
      '1bulan' => ['price' => 35000, 'duration' => '+1 month'],
      '6bulan' => ['price' => 199000, 'duration' => '+6 months'],
      '1tahun' => ['price' => 378000, 'duration' => '+1 year']
    ];

    // Validasi paket
    if (!isset($packages[$package])) {
      show_error('Paket tidak valid.');
    }

    // Ambil data user dari session
    $user_nik = $this->session->userdata('id_pengguna');
    if (!$user_nik) {
      redirect('login'); // Redirect jika belum login
    }

    // Data transaksi Midtrans
    $params = [
      'transaction_details' => [
        'order_id' => 'ORDER-' . $user_nik . '-' . date('YmdHis'),
        'gross_amount' => $packages[$package]['price'],
      ],
      'customer_details' => [
        'first_name' => $this->session->userdata('nama'),
        'email' => $this->session->userdata('email'),
      ],
    ];

    // Generate Snap Token Midtrans
    try {
      $snapToken = \Midtrans\Snap::getSnapToken($params);
    } catch (Exception $e) {
      log_message('error', 'Error generating Snap Token: ' . $e->getMessage());
      show_error('Terjadi kesalahan saat menghubungi Midtrans.');
    }

    // Kirim data ke view
    $data['snapToken'] = $snapToken;
    $data['package'] = $package;
    $data['duration'] = $packages[$package]['duration'];
    $data['id_transaksi'] = $params['transaction_details']['order_id'];
    $data['price'] = $params['transaction_details']['gross_amount'];

    $this->load->view('addons/header');
    $this->load->view('addons/payment_view', $data);
    $this->load->view('addons/footer');
  }

  // Fungsi untuk menyelesaikan pembayaran
  public function finish_payment()
  {
    $nik = $this->session->userdata('id_pengguna');
    $result_data = $this->input->post('result_data');
    $id_transaksi = $this->input->post('id_transaksi');
    $status = $this->input->post('status'); // Mendapatkan status dari form
    $price = $this->input->post('price');
    $package = $this->input->post('package'); // Ambil paket langganan yang dipilih

    // Paket langganan dan durasi
    $packages = [
      '1bulan' => ['price' => 35000, 'duration' => '+1 month'],
      '6bulan' => ['price' => 199000, 'duration' => '+6 months'],
      '1tahun' => ['price' => 378000, 'duration' => '+1 year']
    ];

    if ($result_data) {
      $payment_result = json_decode($result_data, true);

      // Cek apakah order_id ada di dalam result_data
      if (!isset($id_transaksi)) {
        log_message('error', 'order_id tidak ditemukan dalam hasil pembayaran: ' . json_encode($payment_result));
        show_error('order_id tidak ditemukan.');
      }

      // Ambil status transaksi dari Midtrans jika status adalah 'settlement' atau 'pending'
      if ($status == 'settlement' || $status == 'pending') {
        try {
          $status_response = \Midtrans\Transaction::status($id_transaksi);

          // Pastikan status_response adalah objek dan memiliki properti yang dibutuhkan
          if (is_object($status_response) && isset($status_response->transaction_status)) {
            $transaction_status = $status_response->transaction_status;
          } else {
            // Jika status_response bukan objek atau tidak ada property yang diinginkan, log error
            log_message('error', 'Tidak ada status transaksi pada response Midtrans: ' . json_encode($status_response));
            show_error('Status transaksi tidak ditemukan.');
          }
        } catch (Exception $e) {
          log_message('error', 'Error checking transaction status: ' . $e->getMessage());
          show_error('Terjadi kesalahan saat memverifikasi status pembayaran.');
        }
      } else {
        // Gunakan status yang dikirim dari form
        $transaction_status = $status;
      }

      // Tentukan status pembayaran berdasarkan status transaksi
      $status_transaksi = 'Gagal';
      if ($transaction_status == 'settlement') {
        $status_transaksi = 'Lunas';
      } elseif ($transaction_status == 'pending') {
        $status_transaksi = 'Ditagih';
      } elseif ($transaction_status == 'cancel') {
        $status_transaksi = 'Batal';
      }

      // Simpan transaksi ke database jika status valid
      if ($status_transaksi != 'Gagal') {
        $transaction_data = [
          'id_transaksi' => $id_transaksi,
          'nik' => $this->session->userdata('id_pengguna'),
          'status_transaksi' => $status_transaksi,
          'biaya_transaksi' => $price, // Dapatkan biaya transaksi dari hasil
          'expiry_time' => date('Y-m-d H:i:s', strtotime('+24 hours'))
        ];

        // Insert transaksi ke database
        $this->Subscription_model->insert_transaction($transaction_data);

        if ($status_transaksi == 'Lunas') {
          // Tentukan start_sub_date dan end_sub_date berdasarkan paket
          $start_sub_date = date('Y-m-d H:i:s'); // Tanggal pembayaran saat ini
          $end_sub_date = date('Y-m-d H:i:s', strtotime($packages[$package]['duration'])); // Durasi paket

          // Update status langganan pengguna jika pembayaran sukses
          $user_data = [
            'status' => 'Active',
            'start_sub_date' => $start_sub_date,
            'end_sub_date' => $end_sub_date
          ];
          $this->Subscription_model->update_user($nik, $user_data);
          $this->session->set_userdata('status_pengguna', 'Active');
        }
      }

      // Update status pembayaran di database
      $this->Subscription_model->update_transaction($id_transaksi, ['status_transaksi' => $status_transaksi]);

      // Redirect kembali ke halaman target
      redirect('target');
    } else {
      show_error('Data pembayaran tidak valid.');
    }
  }
}
