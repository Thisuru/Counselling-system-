
<?php 

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

    $query = "SELECT * FROM patient WHERE email = '".$email."' AND password = '".md5($password)."'";
    
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) == 0) {

        $query = "INSERT INTO patient VALUES('".$key."','".$name."', '".$dob."', '".$gender."', '".$email."', '".md5($password)."')";

        if (mysqli_query($link, $query)) {
            return true;
        }
    
        return false;

    }

    return false;
    

}

function createCounselor($link,$key,$name, $dob, $gender,$category, $email, $password,$state,$treatmentScore) {

    $query = "SELECT * FROM counselor WHERE email = '".$email."' AND password = '".md5($password)."'";
    
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO counselor VALUES('".$key."','".$name."', '".$dob."', '".$gender."','".$category."', '".$email."', '".md5($password)."','".$state."','".$treatmentScore."')";
        echo $query;
        if (mysqli_query($link, $query)) {
    

            header('Content-Type: application/json');      
            echo json_encode(true, JSON_PRETTY_PRINT); 
        }
    
        header('Content-Type: application/json');      
        echo json_encode(false, JSON_PRETTY_PRINT); 
    }else{
        header('Content-Type: application/json');      
        echo json_encode(false, JSON_PRETTY_PRINT); 
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
    $query = "SELECT * FROM patient WHERE email = '".$email."' AND password = '".md5($password)."'";

    $result = mysqli_query($link, $query);
    $patient = new stdClass;
    if (mysqli_num_rows($result) > 0) {
        // output data of each row

        while($row = mysqli_fetch_assoc($result)) {

           
            $patient->patientId = $row['patientId'];
            $patient->name = $row['name'];
            $patient->dob = $row['dob'];
            $patient->gender = $row['gender'];
            $patient->email = $row['email'];
            // $user = User::withData($name, $dob, $gender, $email);
            //  $_SESSION['user'] = $user;
                                             


        }
        $_SESSION['Patient'] = '1';
        $_SESSION['Patient'] = serialize($patient);
        header('Content-Type: application/json');      
        echo json_encode($patient, JSON_PRETTY_PRINT);     // Now we want to JSON encode these values to send them to $.ajax success.
        exit;   
    } else {
       return null;
    }
}

function authenticateAdmin($link, $email, $password) {
    $query = "SELECT * FROM admin WHERE email = '".$email."' AND password = '".$password."'";

    $result = mysqli_query($link, $query);
    $admin = new stdClass;
    if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {

            
            $admin->adminId = $row['adminId'];
            $admin->email = $row['email'];
            // $user = User::withData($name, $dob, $gender, $email);
            //  $_SESSION['user'] = $user;
             return $admin;

        }
        header('Content-Type: application/json');      
        echo json_encode($admin, JSON_PRETTY_PRINT);     // Now we want to JSON encode these values to send them to $.ajax success.
        exit;   
    } else {
        
        return null;
    }
}


function authenticateCounsellor($link, $email, $password) {
    $query = "SELECT * FROM counselor WHERE email = '".$email."' AND password = '".md5($password)."'";

    $result = mysqli_query($link, $query);
    $counsellor = new stdClass;
    if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {

           
            $counsellor->counsellorId = $row['counselorId'];
            $counsellor->name = $row['name'];
            $counsellor->dob = $row['dob'];
            $counsellor->gender = $row['gender'];
            $counsellor->category = $row['category'];
            $counsellor->email = $row['email'];
            // $user = User::withData($name, $dob, $gender, $email);
            //  $_SESSION['user'] = $user;
             

        }
        header('Content-Type: application/json');      
        echo json_encode($counsellor, JSON_PRETTY_PRINT);     // Now we want to JSON encode these values to send them to $.ajax success.
        exit;  
    } else {
       
        return null;
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

function viewNotApprovedCounsellors($link){
    $query = "SELECT * FROM counselor WHERE state = '0'";
    $result = mysqli_query($link, $query)or die("Error");
    $not_apprived_counsellors_list = array();
    if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {

            $notApprovedCounsellors = new stdClass;
            $notApprovedCounsellors->counselorId = $row["counselorId"];
            $notApprovedCounsellors->name = $row["name"];
            $notApprovedCounsellors->dob = $row["dob"];
            $notApprovedCounsellors->gender = $row["gender"];
            $notApprovedCounsellors->email = $row["email"];
            $notApprovedCounsellors->category = $row["category"];
            
            //  $_SESSION['user'] = $user;

            // echo json_encode($row);

            array_push($not_apprived_counsellors_list, $notApprovedCounsellors);

        }

        // echo print_r($not_apprived_counsellors_list);
        return  $not_apprived_counsellors_list;
    } else {
        return null;
    }

}

function viewApprovedCounsellors($link){
    $query = "SELECT * FROM counselor WHERE state = '1'";
    $result = mysqli_query($link, $query)or die("Error");
    $not_apprived_counsellors_list = array();
    if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {

            $notApprovedCounsellors = new stdClass;
            $notApprovedCounsellors->counselorId = $row["counselorId"];
            $notApprovedCounsellors->name = $row["name"];
            $notApprovedCounsellors->dob = $row["dob"];
            $notApprovedCounsellors->gender = $row["gender"];
            $notApprovedCounsellors->email = $row["email"];
            $notApprovedCounsellors->category = $row["category"];
            
            //  $_SESSION['user'] = $user;

            // echo json_encode($row);

            array_push($not_apprived_counsellors_list, $notApprovedCounsellors);

        }

        // echo print_r($not_apprived_counsellors_list);
        return  $not_apprived_counsellors_list;
    } else {
        return null;
    }



}

function approveCounselor($link,$counselorId){

    echo $counselorId;
    $query = "UPDATE counselor SET state = '1' WHERE counselorId = $counselorId";
    $result = mysqli_query($link, $query)or die("Error");

    return $result;


}

function unApproveCounselor($link,$counselorId){
    echo $counselorId;
    $query = "UPDATE counselor SET state = false WHERE counselorId = $counselorId";
    $result = mysqli_query($link, $query)or die("Error");

    return $result;


}

function addMarks($link, $patientId, $marks, $date_time, $to_answer_table){
    $result = '';
    $answers_array = $to_answer_table['answers'];
    foreach($answers_array as $key => $value){
        $questionId = $key;
        foreach($value as $key2 => $value2){
            
            $answer = $value2;
            $score = 0;
         if($answer == 'a'){
             $answer = 'answer1';
             $score = 1;
         }elseif($answer == 'b'){
             $answer = 'answer2';
             $score = 2;
         }elseif($answer == 'c'){
            $answer = 'answer3';
            $score = 3;
         }elseif($answer == 'd'){
            $answer = 'answer4';
            $score = 4;
         }

         $query = "INSERT INTO answers(patientId,questionId,date_time,answer,score)VALUES('".$patientId."','".$questionId."','".$date_time."','".$answer."','".$score."')";
         $result = mysqli_query($link, $query)or die("Error");   
         
            // print_r($answer);
        
            //Here 0,1,2,3 Will be contained inside the $key variable.
            //Code to insert the data comes here
         }
        
        //Here 0,1,2,3 Will be contained inside the $key variable.
        //Code to insert the data comes here
     }

    $query = "INSERT INTO patient_marks(patientId,marks,date_time)VALUES('".$patientId."','".$marks."','".$date_time."')";
    $result1 = mysqli_query($link, $query)or die("Error");


     if($result == 1 && $result1 == 1){
        return TRUE;
     }else{
        return TRUE;
     }    // "INSERT INTO users VALUES('".$name."', '".$dob."', '".$gender."', '".$account_type."', '".$email."', '".$password."')";


}


function getquestions($link){
    $query = "SELECT * FROM questionnaire";
    $result = mysqli_query($link, $query)or die("Error");
    $question_list = array();
    if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {

            $questions = new stdClass;
            $questions->questionId = $row["questionId"];
            $questions->question = $row["question"];
            $questions->answer1 = $row["answer1"];
            $questions->answer2 = $row["answer2"];
            $questions->answer3 = $row["answer3"];
            $questions->answer4 = $row["answer4"];
            
            //  $_SESSION['user'] = $user;

            // echo json_encode($row);

            array_push($question_list, $questions);

        }

        // echo print_r($not_apprived_counsellors_list);
        return  $question_list;
    } else {
        return null;
    }



}


function getSelectedCounsellors($link,$counsellor_type){
    $query = "SELECT * FROM counselor WHERE state = '0' AND category = '".$counsellor_type."' ";
    $result = mysqli_query($link, $query)or die("Error");
    $counsellors_list = array();
    if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {

            $Counsellors = new stdClass;
            $Counsellors->counselorId = $row["counselorId"];
            $Counsellors->name = $row["name"];
            $Counsellors->dob = $row["dob"];
            $Counsellors->gender = $row["gender"];
            $Counsellors->email = $row["email"];
            $Counsellors->category = $row["category"];
            
            //  $_SESSION['user'] = $user;

            // echo json_encode($row);

            array_push($counsellors_list, $Counsellors);

        }

       
        return  $counsellors_list;
    } else {
        return null;
    }



}

function patientSelectCounsellor($link, $counsellorId,$patientId,$date){
    $query = "INSERT INTO patient_select_counselor(patientId,counselorId,date_time) VALUES ('".$patientId."', '".$counsellorId."', '".$date."')";
    if (mysqli_query($link, $query)) {
        // header('Content-Type: application/json');
        // echo json_encode(true, JSON_PRETTY_PRINT); 
        return true;
    }else{
        return false;
    }
    
}




























?>