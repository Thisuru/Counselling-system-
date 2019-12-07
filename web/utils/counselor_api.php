<?php


require ('database_api.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){

    if (isset($_POST['profile'])) {

        $counselorId = $_POST['counselorId'];
        $counsellorProfile = viewCounsellorProfile($link,$counselorId);
        // $_SESSION['Patient'] = '1';
        // $_SESSION['patient'] = serialize($patient);
        // return $not_approved_counsellorslist;
        header('Content-Type: application/json');
        echo json_encode($counsellorProfile);
        // exit( json_encode($not_approved_counsellorslist));
        // echo json_encode($not_approved_counsellorslist);
        // exit(json_encode($not_approved_counsellorslist));
    }

 




    if(isset($_POST['view_patients'])){

        $counselorId = $_POST['counselorId'];
        $result = viewPatients($link,$counselorId);

        header('Content-Type: application/json');
        echo json_encode($result);


    }

    if (isset($_POST['view_answers'])) {
            
        $patientId	= $_POST['patientId'];
        $date_time = $_POST['date_time'];

        $result = getAllAnsewers($link, $patientId, $date_time);
        header('Content-Type: application/json');      
        echo json_encode($result, JSON_PRETTY_PRINT); 
    
    
    
    }

    if (isset($_POST['view_distinct'])) {
            
        $patientId	= $_POST['patientId'];

        $result = getDistinctAnswerTimes($link, $patientId);
        header('Content-Type: application/json');      
        echo json_encode($result, JSON_PRETTY_PRINT); 
    
    
    
    }




    if (isset($_POST['updateIsAnsweredState'])) {
         
        $patientId	= $_POST['patientId'];

        $result = updateIsAnsweredState($link,$patientId);
        header('Content-Type: application/json');      
        echo json_encode($result, JSON_PRETTY_PRINT); 
    
    
    
    }




    
    }


    







?>