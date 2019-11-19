<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>User Registration</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
<div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
    <div class="wrapper wrapper--w780">
        <div class="card card-3">
            <div class="card-heading"></div>
            <div class="card-body">
                <h2 class="title">Registration Info</h2>
                <form method="POST">
                    <div class="input-group">
                        <input class="input--style-3" type="text" placeholder="Name" name="name" required>
                    </div>
                    <div class="input-group">
                        <input class="input--style-3 js-datepicker" type="text" placeholder="Birthdate" name="birthday" required>
                        <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                    </div>
                    <div class="input-group">
                        <div class="rs-select2 js-select-simple select--no-search">
                            <select name="gender" required>
                                <option disabled="disabled" selected="selected">Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                            <div class="select-dropdown"></div>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="rs-select2 js-select-simple select--no-search">
                            <select id="selectBox" onchange="changeFuncCounsellor();" name="account_type" required>
                                <option disabled="disabled" selected="selected">Account Type</option>
                                <option value>Patient</option>
                                <option value>Counsellor</option>
                            </select>
                            <div class="select-dropdown"></div>
                        </div>
                    </div>

                    <div id="counsellorDiv" class="input-group">
                        <div class="rs-select2 js-select-simple select--no-search">
                            <select id="counsellorBox" onchange="counsellorSelect();" name="account_type" required>
                                <option disabled="disabled" selected="selected">Account Type</option>
                                <option value>Health</option>
                                <option value>Brain Debug</option>
                                <option value>Physical Debug</option>
                            </select>
                            <div class="select-dropdown"></div>
                        </div>
                    </div>

                    <div class="input-group">
                        <input class="input--style-3" type="email" placeholder="Email" name="email" required>
                    </div>
                    <div class="input-group">
                        <input class="input--style-3" type="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="p-t-10">
                        <button class="btn btn--pill btn--green" name="submit" type="submit">Register</button>
                    </div>
                </form>

                <div style="margin-top: 10px" class="text-center p-t-136">
                    <a class="txt2" href="./login.php">
                        Already registered? Click here to login.
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jquery JS-->
<script src="vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script>

<!-- Main JS-->
<script src="js/global.js"></script>

</body>

</html>
<!-- end document-->

<script>

$( document ).ready(function() {
    console.log( "ready!" );
    $("#counsellorDiv").hide()
});

function changeFuncCounsellor(){
    selectedText = $('#selectBox :selected').text();    
    // console.log("TEccccccccc")
    // console.log(text)
    if(selectedText == "Counsellor"){
        $("#counsellorDiv").show()
    }
}

</script>

<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/12/19
 * Time: 4:24 PM
 */
require ('utils/database_api.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $dob = $_POST['birthday'];
    $gender = $_POST['gender'];
    $account_type = $_POST['account_type'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $isSussessful = createUser($link, $name, $dob, $gender, $account_type, $email, $password);

    if ($isSussessful) {
        echo "Data Insertion Successful!";
    } else {
        echo 'Data Insertion Failed!';
    }
}

?>