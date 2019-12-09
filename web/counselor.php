<?php

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
		<title>Counselling System</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="counselorTemp/assets/css/main.css" />
        <link href=https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css>
	</head>
	<body class="is-preload">

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="#" class="image avatar"><img src="counselorTemp/images/women.jpg" alt="" /></a>
					<h1><strong  id="h1name">I am </strong> & I treat for <br> <strong id="category"></strong> category.<br />
					My email is <strong  id="email"></strong> and <strong id="state">State </strong></h1>
				</div>
			</header>

		<!-- Main -->
			<div id="main">

				<!-- One -->
					<section id="one">
						<header class="major">
							<h1>Conselor Profile Page</h1>
                            <br><br>
						</header>
                        <h4>Why seek counseling?</h4>
						<p>We all take great care of our physical health. Many of us go for regular health checks to ensure our blood pressure, blood sugar, cholesterol etc are all within limits. We will consult a dentist for a toothache, a doctor for a stomach ache and so on.So what about our emotional health and wellbeing? How do we look after that? Physical and emotional wellbeing are closely intertwined; they go hand in hand and we cannot have one without the other.I believe that most of the time, we are able to maintain good emotional wellbeing without any assistance. We spend time doing the things we enjoy, we carve out quality time with family and friends, we are in touch with our emotions and so on. We are able to sort out most issues/problems successfully by using our inherent strengths and resources.</p>
						<br>
                        <ul class="actions">
							<li><a href="#" class="button">Learn More</a></li>
						</ul>
					</section>
                <!-- Dta -->

<br>

<h1>Selected Patients</h1><br>
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

    <!-- <div>
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
</div> -->

<br><br>

<!-- <div>
<h1>Patient Answers</h1>
<table id="viewanswers" class="table table-striped table-bordered" style="width:100%" style="width:100%">
        <thead>
            <tr>
                <th>Question</th>
                <th>Answer</th>
            </tr>
        </thead>
    </table>
</div> -->

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
						<li>&copy; Untitled</li><li>Design: <a href="#">Counselor</a></li>
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
                        console.log(res["name"])
                        
                        $('#h1name').append(res["name"])
                        $('#category').append(res["category"])
                        $("#email").append(res["email"])
                        $("#state").append(res["state"])
                        // $.each(res, function(index, value) {
                        //     // $('#h1name').append($('<h1>').text(value.displayname));
                        //     console.log("key is ",index, ":", value["name"])
                        // });
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
                    }
                });

}

function patient_data(data){
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
