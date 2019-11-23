<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 6/30/19
 * Time: 10:23 PM
 */

// require ('database_api.php');
// // $dbhost = 'localhost';
// // $dbuser = 'root';
// // $dbpass = '';
// // $dbname = 'web_db';
// // $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


// // if (!$link) {
// //     echo "Error: Unable to connect to MySQL." . PHP_EOL;
// //     echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
// //     echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
// //     exit;
// // } else {
// //     //echo 'db connected!';
// // }


// if($_SERVER["REQUEST_METHOD"]=="POST"){

//     if (isset($_POST['get'])) {

//         $chatMessages = getMessages($link);

//         header('Content-Type: application/json');
//         echo json_encode($chatMessages);

//     } else {
//         $counsellor = $_POST;

//         $counsellor = json_encode($counsellor);

//         $name = $counsellor[0];
//         $dob = $counsellor[1];
//         $gender = $counsellor[2];
//         $category = $counsellor[3];
//         $email = $counsellor[4];
//         $password = $counsellor[5];
//         $state = 0;

//         $isSussessful = createCounselor($name, $dob, $gender,$category,  $email, $password,$state);
//         if ($isSussessful) {
//             echo "Data Insertion Successful!";
//         } else {
//             echo 'Data Insertion Failed!';
//         }
        
//     }

// }



// function getMessages($link) {

//     $counsellor = $_POST['counsellor'];
//     $patient = $_POST['patient'];

//     return getChatMessages($link, $counsellor, $patient);

// }


?>