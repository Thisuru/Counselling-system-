<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 6/30/19
 * Time: 10:23 PM
 */

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
    
    }


    







?>