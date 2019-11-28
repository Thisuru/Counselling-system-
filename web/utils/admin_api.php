<?php


require ('database_api.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){

    if (isset($_POST['not_approved'])) {
        $not_approved_counsellorslist = viewNotApprovedCounsellors($link);
        // $_SESSION['Patient'] = '1';
        // $_SESSION['patient'] = serialize($patient);
        // return $not_approved_counsellorslist;
        header('Content-Type: application/json');
        echo json_encode($not_approved_counsellorslist);
        // exit( json_encode($not_approved_counsellorslist));
        // echo json_encode($not_approved_counsellorslist);
        // exit(json_encode($not_approved_counsellorslist));
    }

    if(isset($_POST['approved'])){

        $approved_counselors = viewApprovedCounsellors($link);

        header('Content-Type: application/json');
        echo json_encode($approved_counselors);

    }


    if(isset($_POST['approve_counselor'])){

        $counselorId = $_POST['counselorId'];
        
        $result = approveCounselor($link,$counselorId);

        header('Content-Type: application/json');
        echo json_encode($result);

    }


    if(isset($_POST['un_approve_counselor'])){

        $counselorId = $_POST['counselorId'];
        $result = unApproveCounselor($link,$counselorId);

        header('Content-Type: application/json');
        echo json_encode($result);


    }




    
    }


    







?>