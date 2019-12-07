<?php
session_start();
require ('utils/database_api.php');
$user = unserialize($_SESSION['counsellor']);

if ($user == null) {
    $user = unserialize($_SESSION['counsellor']);
    
}

if ($user == null) {
    header("location: 404.php");
    exit();
}

?>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Create News</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-1.jpg">

        <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    Site Name
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="newsfeed.php">
                        <i class="pe-7s-note2"></i>
                        <p>News Feed</p>
                    </a>
                </li>
                <li>
                    <a href="generatenews.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Generate News</p>
                    </a>
                </li>
                <li class="active">
                    <a href="addmusic.php">
                        <i class="pe-7s-plus"></i>
                        <p>Add Music</p>
                    </a>
                </li>
                <li>
                    <a href="music.php">
                        <i class="pe-7s-music"></i>
                        <p>Music</p>
                    </a>
                </li>
                <li>
                    <a href="livechat.php">
                        <i class="pe-7s-chat"></i>
                        <p>Live Chat</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Music</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#">
                                <p>Log out</p>
                            </a>
                        </li>
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Add Music</h4>
                            </div>
                            <div class="content">
                                <form action="addmusic.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Admin email</label>
                                                <input type="text" class="form-control" disabled placeholder="Email" value="<?php echo $user->getEmail()?>">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Admin Name</label>
                                                <input type="text" class="form-control" disabled placeholder="Name" value="<?php echo $user->getName()?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input name="title" type="text" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input name="description" type="text" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Category</label>
                                            <div class="form-group">
                                                <select name="category" class="form-control" required>
                                                    <option value="concentration_music">Concentration Music</option>
                                                    <option value="sleeping_music">Sleeping Music</option>
                                                    <option value="study_mode_music">Study Mode Music</option>
                                                    <option value="encourage_music">Encourage Music</option>
                                                    <option value="motivation_music">Motivation Music</option>
                                                    <option value="entertaining_music">Entertaining Music</option>
                                                    <option value="relaxation_music">Relaxation Music</option>
                                                    <option value="meditation_music">Music For Meditation</option>
                                                    <option value="stress_releasing_music">Stress Releasing Music</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>MP3 File</label>
                                            <div class="card card-user">
                                                <input id="audio" name="audio" style="width: 100%" type="file" class="btn btn-default btn-fill" value="Upload Audio" required/>
                                            </div>
                                        </div>
                                    </div>

                                    <button name="submit" type="submit" class="btn btn-info btn-fill pull-right">Upload</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">

                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">Site Name</a>, all rights reserved
                </p>
            </div>
        </footer>

    </div>
</div>

<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="background-color: #DAF2D6">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Success</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                News feed updated successfully.!
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="failModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="background-color: #FED5D9">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Failed</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                News feed could not be updated.!
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>

<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/19/19
 * Time: 11:52 AM
 */

if (isset($_POST['submit'])) {
    $email = $user->getEmail();
    $name = $user->getName();
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $date_time = date('Y-M-d_h:i');

    if(isset($_FILES['audio']) && $_FILES['audio']['error'] == 0){
        $errors= array();
        $file_name = rand().$_FILES['audio']['name'];
        $file_size =$_FILES['audio']['size'];
        $file_tmp =$_FILES['audio']['tmp_name'];
        $file_type=$_FILES['audio']['type'];

        if(empty($errors)==true){
            move_uploaded_file($file_tmp,"./audio/".$file_name);

            $isSuccessful = createMusic($link, $email, $name, $title, $description, $file_name, $date_time, $category);

            if ($isSuccessful) {
                echo "<script>$(\"#myModal\").modal('show');</script>";
            }

        }else{
            print_r($errors);
            echo "<script>$(\"#failModal\").modal('show');</script>";
        }
    }
}

function createMusic($link, $email, $name, $title, $description, $file_name, $date_time, $category) {

    $music_rec = (new MusicRecord)->withoutMusicId($file_name, $email, $name, $title, $description, $date_time, $category);
    $isSuccessful = addMusic($link, $music_rec);

    return $isSuccessful;
}

?>