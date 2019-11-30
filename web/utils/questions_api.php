<?php
session_start(); 

require ('database_api.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){

    if (isset($_POST['questionMarks'])) {
         
        $patientId	= $_POST['patientId'];
        $marks	= $_POST['score'];
        $date_time = $_POST['date'];

        $result = addMarks($link, $patientId, $marks, $date_time);
        header('Content-Type: application/json');      
        echo json_encode($result, JSON_PRETTY_PRINT); 
    
    
    
    }
    

    









    
    }


    







?>