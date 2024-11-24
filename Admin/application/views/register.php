<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>LOGIN</title>
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
                    <img src="/assets/spasy.png" class="img-fluid" style="width: 250px;">
                </div>
            </div>

            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4 text-center">
                        <h2>Sign Up</h2>
                    </div>

                    <div class="input-group mb-3">
                        <div class="col-2 rounded-2 d-flex justify-content-center align-items-center"
                            style="background: #416D19">
                            <img src="assets/Vector.png">
                        </div>
                        <input type="text" name="username" class="form-control form-control-lg bg-light fs-6"
                            placeholder="Username">
                    </div>


                    <div class="input-group mb-3">
                        <div class="col-2 rounded-2 d-flex justify-content-center align-items-center"
                            style="background: #416D19">
                            <img src="assets/Vector.png">
                        </div>
                        <input type="text" name="nik" class="form-control form-control-lg bg-light fs-6"
                            placeholder="NIK">
                    </div>

                    <div class="input-group mb-3">
                        <div class="col-2 rounded-2 d-flex justify-content-center align-items-center"
                            style="background: #416D19">
                            <img src="assets/Kunci Password.png">
                        </div>
                        <input type="password" name="password" class="form-control form-control-lg bg-light fs-6"
                            placeholder="Password">
                        <div class="col-2 rounded-2 d-flex justify-content-center align-items-center bg-light">
                            <img src="assets/Group 1.png" style="width: 20px;">
                        </div>
                    </div>

                    <div class="input-group mb-1">
                        <div class="col-2 rounded-2 d-flex justify-content-center align-items-center"
                            style="background: #416D19">
                            <img src="assets/Kunci Password.png">
                        </div>
                        <input type="password" name="kunci password" class="form-control form-control-lg bg-light fs-6"
                            placeholder="Kunci Password">
                    </div>

                    <div class="input-group mb-3 p-3">
                        <button class="btn btn-lg btn-primary w-100 fs-6">Sign In</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>