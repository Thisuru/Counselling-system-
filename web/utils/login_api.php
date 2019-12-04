<?php
session_start(); 

require ('database_api.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){

    if (isset($_POST['patient'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $patient = authenticatePatient($link, $email, $password);



        $_SESSION['Patient'] = '1';
        $_SESSION['Patient'] = serialize($patient);
        header('Content-Type: application/json');      
        echo json_encode($patient, JSON_PRETTY_PRINT);     // Now we want to JSON encode these values to send them to $.ajax success.
        exit($patient);                              
 
    
    
    
    
    }
    
    if(isset($_POST['admin'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        
       $admin = authenticateAdmin($link, $email, $password);
       $_SESSION['Admin'] = '1';
       $_SESSION['admin'] = serialize($admin);
       header('Content-Type: application/json');      
       echo json_encode($admin, JSON_PRETTY_PRINT);     // Now we want to JSON encode these values to send them to $.ajax success.
    //    exit($admin);
       
    
    }
    
    if(isset($_POST['counsellor'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $counsellor = authenticateCounsellor($link, $email, $password);
     
        header('Content-Type: application/json');      
        echo json_encode($counsellor, JSON_PRETTY_PRINT);     // Now we want to JSON encode these values to send them to $.ajax success.
        exit($counsellor);
    
    
    }








    
    }


    







?>