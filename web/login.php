<?php session_start(); 

require ('utils/database_api.php');

if(isset($_SESSION['Patient'])){
    header('Location: Questionnaire2.php');
    exit();
}
if(isset($_SESSION['Admin'])){
    header('Location: Admin.php');
    exit();
}
if(isset($_SESSION['Counsellor'])){
    header('Location: newsfeed.php');
    exit();
}


?>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>User Login</title>

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
                <h2 class="title">Login</h2>
                
                <div id="acntTypeDropDown" class="input-group">
                        <div class="rs-select2 js-select-simple select--no-search">
                            <select id = "account_type" name="account_type" required>
                                <option disabled="disabled" selected="selected">Account Type</option>
                                <option value="patient" >Patient</option>
                                <option value="counsellor">Counsellor</option>
                                <option value="admin">Admin</option>
                            </select>
                            <div class="select-dropdown"></div>
                        </div>
                </div>

                <form method="POST">
                    <div class="input-group">
                        <input id="email" class="input--style-3" type="email" placeholder="Email" name="email">
                    </div>
                    <div class="input-group">
                        <input id="password" class="input--style-3" type="password" placeholder="Password" name="password">
                    </div>
                </form>
                <div class="p-t-10">
                        <input type="button" class="btn btn--pill btn--green" onclick="login_user()" value="Login" />
                </div>
                <div style="margin-top: 10px" class="text-center p-t-136">
                    <a class="txt2" href="./register.php">
                        Don't have an account? Register.
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

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->

<script>
  account_type = ""
 $('#account_type').change(function(){
     var status = this.value;
     account_type = status;
  
  });

function login_user(){
    if(account_type == ""){
        alert("check your Inputs")
    }

email = $('#email').val()
password = $('#password').val()



    if(account_type === "patient"){
     console.log(email, password,"patient")

            $.ajax({
                    type: "POST",
                    url: 'utils/login_api.php',
                    data: {
                        "patient":1,
                        "email" :email,
                        "password" : password,
                    },
                    success: function(data){
                        if(data !== false){
                            localStorage.setItem('testObject', JSON.stringify(data));
                            if(data['isAnswered'] === '0'){
                                location.href = "Questionnaire2.php";
                            }else if(data['isAnswered'] === '1'){
                                var counselorData = JSON.parse(localStorage.getItem('counselorObject'));
                                
                                if(counselorData === null){
                                    window.alert("request for appointment")
                                }else{
                                    location.href = "livechat.php";
                                }
                            }
                            
                        }else{
                            window.alert("check email or password")
                        }
                    
                    },
                    fail: function (error) {
                        console.log(error);
                    }
                });


    }
    if(account_type === "admin"){
      console.log("admin",email,password)
      $.ajax({
                    type: "POST",
                    url: 'utils/login_api.php',
                    data: {
                        "admin":1,
                        "email" :email,
                        "password" : password,
                    },
                    success: function(data){
                        location.href = "admin.php";
                    },
                    fail: function (error) {
                        console.log(error);
                    }
                });

    }
    if(account_type === "counsellor"){
            $.ajax({
                    type: "POST",
                    url: 'utils/login_api.php',
                    data: {
                        "counsellor":1,
                        "email" :email,
                        "password" : password,
                    },
                    success: function(data){
                        if(data === null){
                            window.alert("Your not Registered")
                            // location.href = "login.php";
                        }
                        else if(data===false){
                            window.alert("Wait For Admin's Approval")
                        }
                        else if(data !== null){
                            localStorage.setItem('counselorObject', JSON.stringify(data));
                            location.href = "counselor.php";
                        }
                    },
                    fail: function (error) {
                        console.log(error);
                    }
                });
    }

}






</script>


