<?php
session_start(); 

require ('database_api.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){

    if (isset($_POST['get_coounsellors'])) {
        $counsellor_type = $_POST['counsellorType'];


        $counsellors = getSelectedCounsellors($link, $counsellor_type);
    
        header('Content-Type: application/json');
        echo json_encode($counsellors, JSON_PRETTY_PRINT);     // Now we want to JSON encode these values to send them to $.ajax success.
                                  
 
    
    
    
    
    }

    if (isset($_POST['select_counselor'])) {
        $counsellorId = $_POST['counselorId'];
        $patientId = $_POST['patientId'];
        $date = $_POST['Date'];


        $result = patientSelectCounsellor($link, $counsellorId,$patientId,$date);

        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);     // Now we want to JSON encode these values to send them to $.ajax success.
                                  
 
    
    
    
    
    }
    

    









    
    }


    







?>