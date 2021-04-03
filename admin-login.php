<?php
include_once('header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #bde5f2;
        }
    </style>

</head>

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-md-5 p-0 d-none d-lg-block">
                                <div id="header" class="pt-5 pl-5">
                                    <img src="flagCanada.gif" width="55px">
                                </div>
                                <h1 class="h5 p-5">Canadian COVID-19 Tracking Application</h1>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1>Admin Login</h1>
                                    </div>
                                    <form class="user" action="Model/validate.php" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="medicare_num" id="medicare_num" aria-describedby="emailHelp" placeholder="Medicare Num">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                                        </div>
                                        <input type="hidden" name="sourcePage" value="admin" />
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <?php
                                        if (isset($_GET["status"])) {

                                            switch ($_GET["status"]) {
                                                case "1001":
                                                    echo "<div align='middle'><font color='red'>Invalid medicare number and/or password.</font></div>";
                                                    break;
                                                case "2001":
                                                    echo "<div align='middle'><font color='red'>This user does not have administrative privileges.</font></div>";
                                                    break;
                                            }
                                        }
                                        ?>
                                    </form>
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

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>