<?php
/**
 * Created by PhpStorm.
 * User: aparna_ravihari
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
        $issuccess = senderMessage($link);

        echo $issuccess;
    }

}

function senderMessage($link) {

    $counsellor = $_POST['counsellor'];
    $patient = $_POST['patient'];
    $message = $_POST['message'];

    return sendMessage($link, $counsellor, $patient, $message);
}

function getMessages($link) {

    $counsellor = $_POST['counsellor'];
    $patient = $_POST['patient'];

    return getChatMessages($link, $counsellor, $patient);

}


?>