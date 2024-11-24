<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Register</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #ececec;
        }

        .box-area {
            width: 750px;
        }

        .right-box {
            padding: 40px 30px 40px 40px;
        }


        ::placeholder {
            font-size: 16px;
        }

        .rounded-4 {
            border-radius: 20px;
        }

        .rounded-5 {
            border-radius: 30px;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 shadow box-area" style="background: #9BCF53;">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                <div class="featured-image mb-3">
                    <img src="<?php echo $this->config->item('assets_url') . 'spasy.png' ?>" class="img-fluid" style="width: 250px;">
                </div>
            </div>

            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4 text-center">
                        <h2>Sign Up</h2>
                    </div>

                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <div class="col-2 rounded-2 d-flex justify-content-center align-items-center"
                                style="background: #416D19">
                                <i class="bi bi-person text-white fs-3"></i>
                            </div>
                            <input type="text" name="username" class="form-control bg-light fs-6"
                                placeholder="Username">
                        </div>


                        <div class="input-group mb-3">
                            <div class="col-2 rounded-2 d-flex justify-content-center align-items-center"
                                style="background: #416D19">
                                <i class="bi bi-person-vcard-fill text-white fs-3"></i>
                            </div>
                            <input type="text" name="nik" class="form-control bg-light fs-6"
                                placeholder="NIK">
                        </div>

                        <div class="input-group mb-3">
                            <div class="col-2 rounded-2 d-flex justify-content-center align-items-center"
                                style="background: #416D19">
                                <i class="bi bi-key-fill text-white fs-3"></i>
                            </div>
                            <input type="password" name="password" class="form-control bg-light fs-6"
                                placeholder="Masukkan Password">
                            <button class="btn bg-light" type="button" id="btn-pw">
                                <i id="eye" class="bi bi-eye-fill fs-5 text-dark"></i>
                            </button>
                        </div>

                        <div class="input-group mb-1">
                            <div class="col-2 rounded-2 d-flex justify-content-center align-items-center"
                                style="background: #416D19">
                                <i class="bi bi-key-fill text-white fs-3"></i>
                            </div>
                            <input type="password" name="konfirm_password" class="form-control bg-light fs-6"
                                placeholder="Konfirmasi Password">
                            <button class="btn bg-light" type="button" id="btn-pw2">
                                <i id="eye2" class="bi bi-eye-fill fs-5 text-dark"></i>
                            </button>
                        </div>

                        <div class="input-group mb-3 p-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6">Sign Up</button>
                        </div>
                        <div class="row text-center">
                            <small>Sudah punya akun? <a href="<?php echo site_url('Login') ?>">Sign in disini</a></small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        const passwordInput = document.querySelector('input[name="password"]');
        const passwordInput2 = document.querySelector('input[name="konfirm_password"]');
        const eyeIcon = document.getElementById('eye');
        const eyeIcon2 = document.getElementById('eye2');
        const showPasswordButton1 = document.getElementById('btn-pw');
        const showPasswordButton2 = document.getElementById('btn-pw2');

        showPasswordButton1.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove("bi-eye-fill");
                eyeIcon.classList.add("bi-eye-slash-fill");
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove("bi-eye-slash-fill");
                eyeIcon.classList.add("bi-eye-fill");
            }
        });

        showPasswordButton2.addEventListener('click', function() {
            if (passwordInput2.type === 'password') {
                passwordInput2.type = 'text';
                eyeIcon2.classList.remove("bi-eye-fill");
                eyeIcon2.classList.add("bi-eye-slash-fill");
            } else {
                passwordInput2.type = 'password';
                eyeIcon2.classList.remove("bi-eye-slash-fill");
                eyeIcon2.classList.add("bi-eye-fill");
            }
        });
    </script>
</body>

</html>