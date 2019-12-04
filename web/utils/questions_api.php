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

    if (isset($_POST['questionMarkstoDb'])) {
         
        $patientId	= $_POST['patientId'];
        $marks	= $_POST['score'];
        $date_time = $_POST['date'];
        $question_data = $_POST['questionData'];

        $result = addMarks($link, $patientId, $marks, $date_time, $question_data);
        header('Content-Type: application/json');      
        echo json_encode($result, JSON_PRETTY_PRINT); 
    
    
    
    }

    if (isset($_POST['get_questions'])) {
         


        $result = getquestions($link);
        header('Content-Type: application/json');      
        echo json_encode($result, JSON_PRETTY_PRINT); 
    
    
    
    }
    

    









    
    }


    







?>