<?php
/**
 * Created by PhpStorm.
 * User: aparna_ravihari
 * Date: 5/19/19
 * Time: 9:57 AM
 */
session_start();

require ('utils/database_api.php');
$user = $_SESSION['admin'];

if ($user == null) {
    header("location: 404.php");
    exit();
}

?>

<style>

body {
  font-size: 28px;
}

.nav {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
  position: -webkit-sticky; /* Safari */
  position: sticky;
  top: 0;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}

.active {
  background-color: #4CAF50;
}


</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">


    <header>
            <nav>
                <ul class = "nav">
                    <li><a href="newsfeed.php">News Feed</a></li>
               
                    <li><a href="music.php">Music</a></li>
                    
                    
                </ul>
            </nav>
        </header>



    <title>User Registration</title>
    <!-- <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

<!-- 
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all"> -->
    <link href=https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css>

</head>

<body>
<input id="updateState" type="button" class="Button" onclick="logout()"  value="Logout" />
<div>
<h1>Not Approved Counselors</h1>
<table id="not_approved" class="table table-striped table-bordered" style="width:100%" style="width:100%">
        <thead>
            <tr>
                <th>Counsellor ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Gender</th>
                <th></th>
            </tr>
        </thead>
    </table>
</div>
<div>
    <h1>Approved Counselors</h1>
<table id="approved" class="table table-striped table-bordered" style="width:100%" style="width:100%">
        <thead>
            <tr>
                <th>Counsellor ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Gender</th>
                <th></th>
            </tr>
        </thead>
    </table>


</div>


<script src="vendor/jquery/jquery.min.js"></script>

<!-- <script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script> -->


<script src="js/global.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
</body>

</html>

<script>

$( document ).ready(function() {

    get_approved_data();
    get_not_approved_data();


        
});


function get_approved_data(){

            $.ajax({
                    type: "POST",
                    url: 'utils/admin_api.php',
                    data: {
                        "approved" : "1",
                    },
                    success: function(res){
                        console.log(res)
                        approved_table(res)
                    }
                });

}

function get_not_approved_data(){
    
            $.ajax({
                    type: "POST",
                    url: 'utils/admin_api.php',
                    data: {
                        "not_approved" : "1",
                    },
                    success: function(res){
                        not_approved_table(res)
    
                    }
                });

}


function not_approved_table(data){
    $('#not_approved').DataTable( {
        "processing": true,
        "data": data,
        "columns": [
            { "data": "counselorId" },
            { "data": "name" },
            { "data": "category" },
            { "data": "email" },
            { "data": "dob" },
            { "data": "gender" },
            { data: "counselorId", 
            render: function (data, type, row) {
          return `<input type="button" onclick="approve(${row.counselorId})" value="Approve" />`
        }}
        ]
    } );

}

function approved_table(data){
    $('#approved').DataTable( {
        "processing": true,
        "data": data,
        "columns": [
            { "data": "counselorId" },
            { "data": "name" },
            { "data": "category" },
            { "data": "email" },
            { "data": "dob" },
            { "data": "gender" },
            { data: "counselorId", 
            render: function (data, type, row) {
          return `<input type="button" onclick="unapprove(${row.counselorId})" value="Un_Approve" />`
        }}
        ]
    } );


}


function approve(Id){
         $.ajax({
                    type: "POST",
                    url: 'utils/admin_api.php',
                    data: {
                        "approve_counselor" : "1",
                        "counselorId" : Id
                    },
                    success: function(res){
                        window.location.reload();
    
                    }
                });

}

function unapprove(Id){
            $.ajax({
                    type: "POST",
                    url: 'utils/admin_api.php',
                    data: {
                        "un_approve_counselor" : "1",
                        "counselorId" : Id
                    },
                    success: function(res){
                        window.location.reload();
    
                    }
                });
}

function logout(){
    localStorage.clear();
            $.ajax({
                    type: "POST",
                    url: 'utils/log_out.php',
                    data: {
                        "logout" : "1",
                    },
                    success: function(res){
                      
							location.href = "login.php";
						
    
                    }
                });

}


</script>
