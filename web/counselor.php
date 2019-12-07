<?php
/**
 * Created by PhpStorm.
 * User: aparna_ravihari
 * Date: 5/19/19
 * Time: 9:57 AM
 */
session_start();

require ('utils/database_api.php');
$user = $_SESSION['counsellor'];

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

    <title>Add Music</title>
    <!-- <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- 
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all"> -->
    <link href=https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css>

    <!-- <link href="css/main.css" rel="stylesheet" media="all"> -->
</head>

        <header>
            <nav>
                <ul class = "nav">
                    <li><a href="newsfeed.php">News Feed</a></li>
                    <li><a href="addmusic.php">Add Music</a></li>
                    <li><a href="music.php">Music</a></li>
                    <li><a href="livechat.php">Live Chat</a></li>
                    
                </ul>
            </nav>
        </header>

<body>
<input id="log_out" type="button" class="Button" onclick="logout()"  value="Logout" />

    <div id = "firstView">
        <h1>Selected Patients</h1>
        <table id="approved" class="table table-striped table-bordered" style="width:100%" style="width:100%">
            <thead>
                <tr>
                    <th>Counsellor ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Selected Date And Time</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>


    <div id = "secondView">
        <h1>Patient Past Scores</h1>
        <table id="PastScores" class="table table-striped table-bordered" style="width:100%" style="width:100%">
            <thead>
                <tr>
                    <th>Date And Time</th>
                    <th>Marks</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>

    <div id = "thirdView">
        <h1>Patient Answers</h1>
        <table id="viewanswers" class="table table-striped table-bordered" style="width:100%" style="width:100%">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Answer</th>
                </tr>
            </thead>
        </table>
        <input id="updateState" type="button" class="Button" onclick="updateIsAnsweredState()"  value="enable Questionaire" />
        <input type="button" class="Button" onclick="to_chat()"  value="Chat" />
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

var patientId = '';
var counsellorId = '';

$( document ).ready(function() {

$('#firstView').hide();
$('#secondView').hide();
$('#thirdView').hide();

    view_profile()
    view_selected_patients();
    


        
});

function view_profile(){

    var userData = JSON.parse(localStorage.getItem('counselorObject'));
	counsellorId = userData['counsellorId']
    consellorId = counsellorId;

            $.ajax({
                    type: "POST",
                    url: 'utils/counselor_api.php',
                    data: {
                        "profile" : "1",
                        "counselorId" : counsellorId
                    },
                    success: function(res){
                        console.log(res)
                        
                    }
                });
    
}


function view_selected_patients(){
    var userData = JSON.parse(localStorage.getItem('counselorObject'));
	counsellorId = userData['counsellorId']
            $.ajax({
                    type: "POST",
                    url: 'utils/counselor_api.php',
                    data: {
                        "view_patients" : "1",
                        "counselorId" : counsellorId
                    },
                    success: function(res){
                        patient_data(res)
                        $('#firstView').show();
                        
                    }
                });

}

function patient_data(data){

    if ($.fn.DataTable.isDataTable("#approved")) {
        $('#approved').DataTable().clear().destroy();
    }
    $('#approved').DataTable( {
        "processing": true,
        "data": data,
        "columns": [
            { "data": "patientId" },
            { "data": "name" },
            { "data": "email" },
            { "data": "dob" },
            { "data": "gender" },
            { "data": "date_time" },
            { data: "patientId", 
            render: function (data, type, row) {
          return `<input type="button" onclick="viewPastScores(${row.patientId})" value="past Scores" />`
        }}
        ]
    } );


}




// function not_approved_table(data){
//     $('#not_approved').DataTable( {
//         "processing": true,
//         "data": data,
//         "columns": [
//             { "data": "counselorId" },
//             { "data": "name" },
//             { "data": "category" },
//             { "data": "email" },
//             { "data": "dob" },
//             { "data": "gender" },
//             { data: "counselorId", 
//             render: function (data, type, row) {
//           return `<input type="button" onclick="approve(${row.counselorId})" value="Approve" />`
//         }}
//         ]
//     } );

// }

function viewPastScores(Id){
    console.log(Id)
    patientId = Id;
         $.ajax({
                    type: "POST",
                    url: 'utils/counselor_api.php',
                    data: {
                        "view_distinct" : "1",
                        "patientId" : Id
                    },
                    success: function(res){
                        console.log(res)
                        pastScores(res, Id)
                        $('#secondView').show();
    
                    }
                });

}

function pastScores(data,Id){

    if ($.fn.DataTable.isDataTable("#PastScores")) {
        $('#PastScores').DataTable().clear().destroy();
    }

    $('#PastScores').DataTable( {
        "processing": true,
        "data": data,
        "columns": [
            { "data": "date_time" },
            { "data": "marks" },
            { data: "date_time", 
            render: function (data, type, row) {
                dateArray = []
                dateArray[0] = row
          return `<input type="button" onclick="viewQuestionaire(this,${Id})" custom = "${row.date_time}" value="Questionaire" />`
        }}
        ]
    } );


}

function viewQuestionaire(e,pId){
    var date_time = e.getAttribute('custom');
    console.log(date_time,pId)
            $.ajax({
                    type: "POST",
                    url: 'utils/counselor_api.php',
                    data: {
                        "view_answers" : "1",
                        "date_time" : date_time,
                        "patientId" : pId
                    },
                    success: function(res){
                        console.log(res)
                        viewAnswers(res)
                        $('#thirdView').show();
    
                    }
                });

}

function viewAnswers(data){
    if ($.fn.DataTable.isDataTable("#viewanswers")) {
        $('#viewanswers').DataTable().clear().destroy();
    }
    $('#viewanswers').DataTable( {
        "processing": true,
        "data": data,
        "columns": [
            { "data": "question" },
            { "data": "answer" },
        
        ]
    } );



}

function updateIsAnsweredState(){
    $.ajax({
                    type: "POST",
                    url: 'utils/counselor_api.php',
                    data: {
                        "updateIsAnsweredState" : "1",
                        "patientId" : patientId
                    },
                    success: function(res){
                        if(res === true){
                            $('#updateState').hide();
                        }
                        
    
                    }
                });
}

function to_chat(){
    location.href = 'livechat.php';
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
