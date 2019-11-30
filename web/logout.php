<?php session_start();
if(unset($_SESSION['Patient'])){
    session_destroy();
    header('Location: register.php');
    exit();
}


    // session_start();

    // unset($_SESSION['Counsellor']);
    // session_destroy();
    // header('Location: web/login.php');
    // exit()l
?>