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

    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>



<div>
<h1>Select Your Counsellor</h1>
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
<script src="js/global.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">



</body>

</html>














<script>
$( document ).ready(function() {


get_counsellors()



	
});

function get_counsellors(){

    var counsellor_type  = '';      
    var totalScore = JSON.parse(localStorage.getItem('totalMarks'));
    console.log(totalScore)
    if(totalScore<=10){
        counsellor_type = "Normal Depression"
    }
    if(totalScore > 10 && totalScore <= 16){
        counsellor_type = "Mild mode Depression";
    }
    if(totalScore > 10 && totalScore <= 20){
        counsellor_type = "Borderline Clinical";
    }
    if(totalScore > 20 && totalScore <= 30){
        counsellor_type = "Moderate Depression";
    }
    if(totalScore > 30 && totalScore <= 40){
        counsellor_type = "Sever Depression";
    }
    if(totalScore > 40){
        counsellor_type = "Extream Depression";
    }

    console.log(counsellor_type)

            $.ajax({
                    type: "POST",
                    url: 'utils/patient_api.php',
                    data: {
                        "get_coounsellors" : "1",
                        "counsellorType":counsellor_type
                    },
                    success: function(res){

                        approved_table(res)
    
                    }
                });



 


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
            return `<input type="button" onclick="add_counselor(${row.counselorId})" value="Select" />`

        }}
        ]
    } );


} 

function add_counselor(counselorId){
    console.log(counselorId)
    var userData = JSON.parse(localStorage.getItem('testObject'));
	patientId = userData['patientId']
	date = new Date();
	date = date.toUTCString();
         $.ajax({
                    type: "POST",
                    url: 'utils/patient_api.php',
                    data: {
                        "select_counselor" : "1",
                        "counselorId" : counselorId,
                        "patientId":  patientId,
                        "Date" : date
                    },
                    success: function(res){
                        if(res === true){
							location.href = "livechat.php";
						}
    
                    }
                });

        }


</script>