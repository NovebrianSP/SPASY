<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Langganan</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-rV3aaa3gX7TAh6U7"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px; /* Membatasi lebar card */
        }

        .card-body {
            text-align: center;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 50px;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 50px;
        }

        .card-title {
            font-weight: bold;
            font-size: 24px;
        }

        .card-subtitle {
            font-size: 16px;
            color: #6c757d;
        }

        /* Optional: Hover effect on button */
        .btn-primary:hover,
        .btn-danger:hover {
            transform: scale(1.05);
            transition: all 0.3s ease;
        }

        /* Custom styling for the form inputs */
        .form-control {
            border-radius: 8px;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Proses Pembayaran Langganan</h5>
                <h6 class="card-subtitle mb-4">Silakan selesaikan pembayaran anda sebesar:</h6>
                <h6 class="card-subtitle mb-4">Rp. <?php echo number_format($price, 0) ?></h6>
                <div class="btn-container">
                    <button id="cancel-button" class="btn btn-danger">Batal</button>
                    <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Form untuk kirim hasil pembayaran -->
    <form id="payment-form" method="post" action="<?php echo site_url('subs/finish_payment'); ?>">
        <input type="hidden" name="id_transaksi" value="<?php echo $id_transaksi; ?>">
        <input type="hidden" name="result_data" id="result-data">
        <input type="hidden" name="price" id="price" value="<?php echo $price; ?>">
        <input type="hidden" name="status" id="status">
        <input type="hidden" name="package" value="<?php echo $package; ?>">
        <input type="hidden" name="duration" value="<?php echo $duration; ?>">
    </form>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        var cancelButton = document.getElementById('cancel-button');

        // Tombol pembayaran
        payButton.onclick = function () {
            snap.pay('<?php echo $snapToken; ?>', {
                onSuccess: function (result) {
                    // Berhasil
                    document.getElementById('result-data').value = JSON.stringify(result);
                    document.getElementById('status').value = 'settlement'; // Status pembayaran sukses
                    document.getElementById('payment-form').submit();
                },
                onPending: function (result) {
                    // Pending
                    document.getElementById('result-data').value = JSON.stringify(result);
                    document.getElementById('status').value = 'pending'; // Status pembayaran pending
                    document.getElementById('payment-form').submit();
                },
                onError: function (result) {
                    // Error
                    alert("Pembayaran gagal!");
                    document.getElementById('result-data').value = JSON.stringify(result);
                    document.getElementById('status').value = 'error'; // Status pembayaran gagal
                    document.getElementById('payment-form').submit();
                },
                onClose: function () {
                    // Kirim data cancel ke form
                    var cancelData = {
                        status: "cancel",
                        message: "Pembayaran dibatalkan oleh pengguna."
                    };
                    document.getElementById('result-data').value = JSON.stringify(cancelData);
                    document.getElementById('status').value = 'cancel'; // Status pembayaran dibatalkan
                    document.getElementById('payment-form').submit();
                }
            });
        };

        // Tombol batal
        cancelButton.onclick = function () {
            var cancelData = {
                status: "cancel",
                message: "Pembayaran dibatalkan oleh pengguna."
            };
            document.getElementById('result-data').value = JSON.stringify(cancelData);
            document.getElementById('status').value = 'cancel'; // Status pembayaran dibatalkan
            document.getElementById('payment-form').submit();
        };
    </script>
</body>

</html>
