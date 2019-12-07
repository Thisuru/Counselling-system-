<?php session_start();

require ('utils/database_api.php');

/**
 * Created by PhpStorm.
 * User: aparna_ravihari
 * Date: 5/13/19
 * Time: 11:13 PM
 */

$user = unserialize($_SESSION['patient']);

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
                <li class="active">
                    <a href="generatenews.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Generate News</p>
                    </a>
                </li>
                <li>
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
                    <a class="navbar-brand" href="#">News Feed</a>
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
                                <h4 class="title">Generate News</h4>
                            </div>
                            <div class="content">
                                <form action="generatenews.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" disabled placeholder="Email" value="<?php echo $user->getEmail() ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Name</label>
                                                <input type="text" class="form-control" disabled placeholder="Name" value="<?php echo $user->getName() ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea rows="5" name="description" class="form-control" placeholder="Description" required>Description goes here</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Image</label>
                                            <div class="card card-user">
                                                <div class="image">
                                                </div>
                                                <div style="padding-bottom: 10px" class="author">
                                                    <img id="chosenImage" name="chosenImage" class="pic border-gray" src="assets/img/faces/face-3.jpg" alt="..."/>
                                                </div>
                                                <input id="image" onchange="readURL(this)" name="image" style="width: 100%" type="file" class="btn btn-default btn-fill" value="Upload Image" />
                                            </div>
                                        </div>
                                    </div>

                                    <button name="submit" type="submit" class="btn btn-info btn-fill pull-right">Post</button>
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

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#chosenImage')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</html>

<?php
if (isset($_POST['submit'])) {
    $email = $user->getEmail();
    $name = $user->getName();
    $description = $_POST['description'];
    $date_time = date('Y-M-d_h:i');

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $errors= array();
        $file_name = rand().$_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];

        if($file_size > 2097152){
            $errors[]='File size must be excately 2 MB';
        }

        if(empty($errors)==true){
            move_uploaded_file($file_tmp,"./uploads/".$file_name);

            $isSuccessful = createNews($link, $email, $name, $description, $file_name, $date_time);

            if ($isSuccessful) {
                echo "<script>$(\"#myModal\").modal('show');</script>";
            }

        }else{
            print_r($errors);
            echo "<script>$(\"#failModal\").modal('show');</script>";
        }
    } else {
        //echo "File upload failed";
        $isSuccessful = createNews($link, $email, $name, $description, 'male-reporter.png', $date_time);
        if ($isSuccessful) {
            echo "<script>$(\"#myModal\").modal('show');</script>";
        }
    }
}

function createNews($link, $email, $name, $description, $photo_path, $date_time) {
    $isSuccessful = insertNewsRecord($link, (new NewsRecord)->withoutArtNo($email, $name, $description, $photo_path, $date_time));
    return $isSuccessful;
}
?>