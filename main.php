<?php

?>
<html>

<head>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


    <style>
        body {
            background-color: #bde5f2;
        }

        .container {
            position: fixed;
            top: 50%;
            left: 50%;
            /* bring your own prefixes */
            transform: translate(-50%, -50%);
        }

        #btn {
            font-size: 25px;
        }
    </style>

</head>

<body>


    <div class="container" style="text-align:center;">
        <h1 style="margin-bottom:100px;">Canadian COVID-19 Health Application</h1>
        <div>
            <button style="width:500px;margin-bottom:20px;" type="button" class="btn btn-outline-secondary" onclick="location.href='patient-login.php';">I am a patient</button>
        </div>
        <div>
            <button style="width:500px;margin-bottom:20px;" type="button" class="btn btn-outline-secondary" onclick="location.href='healthcare-login.php';">I am a healthcare worker</button>
        </div>
        <div>
            <button style="width:500px" type="button" class="btn btn-outline-secondary" onclick="location.href='admin-login.php';">I am an admin</button>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>