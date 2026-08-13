<!DOCTYPE html>
<html lang="en">
    

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Personal CV - Login</title>

    <!-- Custom fonts -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/custom-style.css" rel="stylesheet">

    <!-- OVERRIDE TAMPILAN KHUSUS HALAMAN LOGIN -->
    <style>
        /* Mengubah latar belakang biru tua/gradient menjadi PINK SOFT */
        body, body.bg-gradient-primary {
            background-color: #fce8f0 !important;
            background-image: none !important;
        }

        /* Mengubah tombol login menjadi PINK TUA */
        .btn-primary, button[type="submit"] {
            background-color: #c9527d !important;
            border-color: #c9527d !important;
            color: #ffffff !important;
        }

        .btn-primary:hover, button[type="submit"]:hover {
            background-color: #b03e68 !important;
            border-color: #b03e68 !important;
        }

        /* Mengubah warna link bawah menjadi pink */
        a.small {
            color: #c9527d !important;
        }

        /* Mengubah border input saat diklik */
        .form-control:focus {
            border-color: #c9527d !important;
            box-shadow: 0 0 0 0.2rem rgba(201, 82, 125, 0.25) !important;
        }
    </style>

</head>

<body>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5" style="border-radius: 15px;">

                <div class="card-body p-0">

                    <div class="row">

                        <!-- Gambar Samping Bawaan -->
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>

                        <div class="col-lg-6">

                            <div class="p-5">

                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4" style="color: #6d4150 !important; font-weight: 700;">
                                        Welcome Back!
                                    </h1>
                                </div>

                                <form class="user" action="process_login.php" method="post">

                                    <div class="form-group">
                                        <input
                                            type="email"
                                            class="form-control form-control-user"
                                            id="email"
                                            name="email"
                                            placeholder="Enter Email Address..."
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <input
                                            type="password"
                                            class="form-control form-control-user"
                                            id="password"
                                            name="password"
                                            placeholder="Password"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox"
                                                class="custom-control-input"
                                                id="customCheck">
                                            <label class="custom-control-label"
                                                for="customCheck" style="color: #6d4150;">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit"
                                        class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>

                                </form>

                                <hr>

                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">
                                        Forgot Password?
                                    </a>
                                </div>

                                <div class="text-center">
                                    <a class="small" href="register.html">
                                        Create an Account!
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts -->
<script src="js/sb-admin-2.min.js"></script>

</body>
</html>