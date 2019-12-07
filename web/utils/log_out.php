<?php


require ('database_api.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){

    if (isset($_POST['logout'])) {

        session_start();
        unset($_SESSION["patient"]);
        unset($_SESSION["counsellor"]);
        unset($_SESSION["admin"]);
        // header("Location: login.php");
        header('Content-Type: application/json');
        echo json_encode(true);
        // exit( json_encode($not_approved_counsellorslist));
        // echo json_encode($not_approved_counsellorslist);
        // exit(json_encode($not_approved_counsellorslist));
    }

    
    }


    







?>