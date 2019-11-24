<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/19/19
 * Time: 9:57 AM
 */
session_start();

require ('utils/database_api.php');

$user = $_SESSION['Admin'];

if ($user == null) {
    header("location: 404.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <title>User Registration</title>
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">


    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
<div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">

<h1>hiiiiiiiiiiiiii<h1>

</div>


<script src="vendor/jquery/jquery.min.js"></script>

<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script>


<script src="js/global.js"></script>

</body>

</html>

<script>

$( document ).ready(function() {
        $.ajax({
                    type: "POST",
                    url: 'Admin.php',
                    data: {
                        "View_not_approved" = "1"
                    },
                    success: function(data){
                        console.log('SUCCESS' + data);
                    },
                    fail: function (error) {
                        console.log(error);
                    }
                });
        });



</script>

