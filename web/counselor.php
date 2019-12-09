<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
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

<!DOCTYPE HTML>

<html>
	<head>
		<title>Strata by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="counselorTemp/assets/css/main.css" />
        <link href=https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css>
	</head>
	<body class="is-preload">

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="#" class="image avatar"><img src="counselorTemp/images/avatar.jpg" alt="" /></a>
					<h1><strong>I am Strata</strong>, a super simple<br />
					responsive site template freebie<br />
					crafted by <a href="http://html5up.net">HTML5 UP</a>.</h1>
				</div>
			</header>

		<!-- Main -->
			<div id="main">

				<!-- One -->
					<section id="one">
						<header class="major">
							<h2>Conselor Profile Page</h2>
						</header>
						<p>Accumsan orci faucibus id eu lorem semper. Eu ac iaculis ac nunc nisi lorem vulputate lorem neque cubilia ac in adipiscing in curae lobortis tortor primis integer massa adipiscing id nisi accumsan pellentesque commodo blandit enim arcu non at amet id arcu magna. Accumsan orci faucibus id eu lorem semper nunc nisi lorem vulputate lorem neque cubilia.</p>
						<ul class="actions">
							<li><a href="#" class="button">Learn More</a></li>
						</ul>
					</section>
                <!-- Dta -->



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

    <br><br>

    <div>
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
<br><br>
<div>
<h1>Patient Answers</h1>
<table id="viewanswers" class="table table-striped table-bordered" style="width:100%" style="width:100%">
        <thead>
            <tr>
                <th>Question</th>
                <th>Answer</th>
            </tr>
        </thead>
    </table>
</div>

<div>

</div>


                <!-- Dta -->
			</div>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<ul class="icons">
						<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon brands fa-github"><span class="label">Github</span></a></li>
						<li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</div>
			</footer>

 
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/global.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer ></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" defer></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
            

		<!-- Scripts -->
			<script src="counselorTemp/assets/js/jquery.min.js"></script>
			<script src="counselorTemp/assets/js/jquery.poptrox.min.js"></script>
			<script src="counselorTemp/assets/js/browser.min.js"></script>
			<script src="counselorTemp/assets/js/breakpoints.min.js"></script>
			<script src="counselorTemp/assets/js/util.js"></script>
			<script src="counselorTemp/assets/js/main.js"></script>

	</body>
</html>

<script>

$( document ).ready(function() {

    view_profile()
    view_selected_patients();
    


        
});

function view_profile(){

    var userData = JSON.parse(localStorage.getItem('counselorObject'));
	counsellorId = userData['counsellorId']

            $.ajax({
                    type: "POST",
                    url: 'utils/counselor_api.php',
                    data: {
                        "profile" : "1",
                        "counselorId" : counsellorId
                    },
                    success: function(res){
                        console.log("view_profile")
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
                        
                        $.each( res, function( key, value ) {
                            console.log("RRRRRRRRRRRRRRRRRRRRRRr")
                            console.log(res.keys())
                        });
                    }
                });

}

function patient_data(data){
    console.log("dataaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
    console.log(data)
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
         $.ajax({
                    type: "POST",
                    url: 'utils/questions_api.php',
                    data: {
                        "view_distinct" : "1",
                        "patientId" : Id
                    },
                    success: function(res){
                        console.log(res)
                        pastScores(res, Id)
    
                    }
                });

}

function pastScores(data,Id){
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
                    url: 'utils/questions_api.php',
                    data: {
                        "view_answers" : "1",
                        "date_time" : date_time,
                        "patientId" : pId
                    },
                    success: function(res){
                        console.log(res)
                        viewAnswers(res)
    
                    }
                });

}

function viewAnswers(data){
    $('#viewanswers').DataTable( {
        "processing": true,
        "data": data,
        "columns": [
            { "data": "question" },
            { "data": "answer" },
        
        ]
    } );



}






</script>
