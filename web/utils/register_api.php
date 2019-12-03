<?php
session_start(); 

require ('database_api.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){

    if (isset($_POST['counselor'])) {
        $name = $_POST['name'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $category = $_POST['category'];
        $state = $_POST['state'];
        $treatmentScore = $_POST['treatmentScore'];
        $key = "";
        $isSussessful = createCounselor($link,$key, $name, $dob, $gender,$category, $email, $password,false,$treatmentScore);
    
    
    
        echo $name;
        // exit($name;$dob;$gender;$email;$password);
    
        if ($isSussessful) {
            header('Content-Type: application/json');      
            echo json_encode(true, JSON_PRETTY_PRINT); 
        } else {
            echo 'Data Insertion Failed!';
        }
    }
    
    else if(isset($_POST['patient'])){
        $name = $_POST['name'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $key = "";
    
        $isSussessful = createPatient($link,$key, $name, $dob, $gender, $email, $password);
    

        // exit($name;$dob;$gender;$email;$password);
    
        if ($isSussessful) {
            header('Content-Type: application/json');  
            echo json_encode(true, JSON_PRETTY_PRINT); 
            exit;
        } else {
            echo 'Data Insertion Failed!';
            exit;
        }
    
    
    }



    
}