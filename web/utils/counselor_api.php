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




    
    }


    







?>