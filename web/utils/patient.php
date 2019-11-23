<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 6/30/19
 * Time: 10:23 PM
 */

require ('database_api.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){

    if (isset($_POST['get'])) {

        $chatMessages = getMessages($link);

        header('Content-Type: application/json');
        echo json_encode($chatMessages);

    } else {
        $patient = $_POST;
        foreach ($patient as $data){ 
            echo $data;
          }
    }

}

function createPatient($link, $name, $dob, $gender, $email, $password) {
    $query = "INSERT INTO patient VALUES('".$name."', '".$dob."', '".$gender."', '".$email."', '".$password."')";

    if (mysqli_query($link, $query)) {
        return true;
    }

    return false;
}

function getMessages($link) {

    $counsellor = $_POST['counsellor'];
    $patient = $_POST['patient'];

    return getChatMessages($link, $counsellor, $patient);

}


?>