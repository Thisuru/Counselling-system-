<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 3/20/19
 * Time: 1:07 PM
 */

require ('User.php');
require ('NewsRecord.php');
require ('MusicRecord.php');
require ('ChatMessage.php');


$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'web_db';
$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else {
    //echo 'db connected!';
}

//mysqli_close($link);

function createUser($link, $name, $dob, $gender, $account_type, $email, $password) {
    $query = "INSERT INTO users VALUES('".$name."', '".$dob."', '".$gender."', '".$account_type."', '".$email."', '".$password."')";

    if (mysqli_query($link, $query)) {
        return true;
    }

    return false;
}

function createPatient($link,$key, $name, $dob, $gender, $email, $password) {

    $query = "SELECT * FROM patient WHERE email = '".$email."' AND password = '".$password."'";
    
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) == 0) {

        $query = "INSERT INTO patient VALUES('".$key."','".$name."', '".$dob."', '".$gender."', '".$email."', '".$password."')";

        if (mysqli_query($link, $query)) {
            return true;
        }
    
        return false;

    }

    return false;
    

}

function createCounselor($link,$key,$name, $dob, $gender,$category, $email, $password,$state) {

    $query = "SELECT * FROM counselor WHERE email = '".$email."' AND password = '".$password."'";
    
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO counselor VALUES('".$key."','".$name."', '".$dob."', '".$gender."','".$category."', '".$email."', '".$password."','".$state."')";
        echo $query;
        if (mysqli_query($link, $query)) {
    
            echo "sucess";
            return true;
        }
    
        return false;
    }else{
        return false;
    }


    }




function insertNewsRecord($link, $record) {
    $query = "INSERT INTO news_feed(admin_email, admin_name, description, photo_path, date_time) VALUES('".$record->getAdminEmail()."', '".$record->getAdminName()."', '".$record->getDescription()."', '".$record->getPhotoPath()."', '".$record->getDateTime()."')";

    if (mysqli_query($link, $query)) {
        return true;
    }
    return false;
}

function authenticateUser($link, $email, $password) {
    $query = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$password."'";

    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {

            $name = $row['name'];
            $dob = $row['dob'];
            $gender = $row['gender'];
            $account_type = $row['account_type'];
            $email = $row['email'];
            $user = User::withData($name, $dob, $gender, $account_type, $email);

            return $user;

        }
    } else {
        return null;
    }
}

function authenticatePatient($link, $email, $password) {
    $query = "SELECT * FROM patient WHERE email = '".$email."' AND password = '".$password."'";

    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row

        exit('sucess');

        // while($row = mysqli_fetch_assoc($result)) {

        //     $name = $row['name'];
        //     $dob = $row['dob'];
        //     $gender = $row['gender'];
        //     $account_type = $row['account_type'];
        //     $email = $row['email'];
        //     $user = User::withData($name, $dob, $gender, $account_type, $email);

        //     return $user;

        // }
    } else {
        exit('false');
    }
}

function authenticateAdmin($link, $email, $password) {
    $query = "SELECT * FROM admin WHERE email = '".$email."' AND password = '".$password."'";

    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row

        exit('sucess');

        // while($row = mysqli_fetch_assoc($result)) {

        //     $name = $row['name'];
        //     $dob = $row['dob'];
        //     $gender = $row['gender'];
        //     $account_type = $row['account_type'];
        //     $email = $row['email'];
        //     $user = User::withData($name, $dob, $gender, $account_type, $email);

        //     return $user;

        // }
    } else {
        
        exit('false');
    }
}


function authenticateCounsellor($link, $email, $password) {
    $query = "SELECT * FROM counselor WHERE email = '".$email."' AND password = '".$password."'";

    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row

        exit('sucess');

        // while($row = mysqli_fetch_assoc($result)) {

        //     $name = $row['name'];
        //     $dob = $row['dob'];
        //     $gender = $row['gender'];
        //     $account_type = $row['account_type'];
        //     $email = $row['email'];
        //     $user = User::withData($name, $dob, $gender, $account_type, $email);

        //     return $user;

        // }
    } else {
       
        exit('false');
    }
}






















function getAllNews($link) {
    $newslist = array();
    $query = "SELECT * FROM news_feed";
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {

            $article_no = $row['article_no'];
            $email = $row['admin_email'];
            $name = $row['admin_name'];
            $description = $row['description'];
            $photo_path = $row['photo_path'];
            $date_time = $row['date_time'];

            $record = NewsRecord::withArtNo($article_no, $email, $name, $description, $photo_path, $date_time);

            array_push($newslist, $record);

        }
        return $newslist;
    } else {
        return null;
    }
}

function addMusic($link, $music_record){
    $query = "INSERT INTO music(music_path,	admin_email, admin_name, title,	description, date_time, category) VALUES ('".$music_record->getMusicPath()."', '".$music_record->getAdminEmail()."', '".$music_record->getAdminName()."', '".$music_record->getTitle()."', '".$music_record->getDescription()."', '".$music_record->getDateTime()."', '".$music_record->getCategory()."')";
    if (mysqli_query($link, $query)) {
        return true;
    }
    return false;
}

function getMusic($link){
    $musiclist = array();
    $query = "SELECT * FROM music";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {

            $music_id = $row['music_id'];
            $music_path = $row['music_path'];
            $admin_email = $row['admin_email'];
            $admin_name = $row['admin_name'];
            $title = $row['title'];
            $description = $row['description'];
            $date_time = $row['date_time'];
            $category = $row['category'];

            $record = MusicRecord::withMusicId($music_id, $music_path, $admin_email, $admin_name, $title, $description, $date_time, $category);

            array_push($musiclist, $record);

        }
        return $musiclist;
    } else {
        return null;
    }
}

function sendMessage($link, $counsellor, $patient, $message){
    $query = "INSERT INTO chatmessages(counsellor,	patient, message) VALUES ('".$counsellor."', '".$patient."', '".$message."')";
    if (mysqli_query($link, $query)) {
        return true;
    }
    return false;
}

function getChatMessages($link, $counsellor, $patient){
    $chatMessages = array();
    $query = "SELECT * FROM chatmessages WHERE counsellor = '".$counsellor."' AND patient = '".$patient."' ORDER BY timestamp";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $chatMessages[] = $row;
            }
        }
        return $chatMessages;
    } else {
        return null;
    }
}

?>