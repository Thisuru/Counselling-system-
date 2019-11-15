<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/19/19
 * Time: 9:57 AM
 */
session_start();

require ('utils/database_api.php');

$user = unserialize($_SESSION['user']);

if ($user == null) {
    header("location: 404.php");
    exit();
}

$music_records = getMusic($link);

function showMusic($music_records, $category) {
    $count = 0;
    for ($i = 0; $i < count($music_records); $i++) {

        if ($music_records[$i]->getCategory()==$category) {

            $count++;

            echo "
                            <div class=\"col-md-6\">
                                <div class=\"card card-user\">
                                    <div class=\"image\">
                                        <img src=\"https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400\" alt=\"...\"/>
                                    </div>
                                    <div class=\"content\">
                                        <div class=\"author\">
                                            <img class=\"avatar border-gray\" src=\"assets/img/music-01.jpg\" alt=\"...\"/>

                                            <h4 class=\"title\">".$music_records[$i]->getTitle()."<br />
                                                <small>".$music_records[$i]->getDescription()."</small>
                                            </h4>
                                        </div>
                                        <audio style=\"width: 100%\" controls>
                                            <source src=\"./audio/".$music_records[$i]->getMusicPath()."\" type=\"audio/mpeg\">
                                        </audio>
                                    </div>
                                </div>
                            </div>
                            ";
        }


    }
    if ($count == 0) {
        echo '<p style="margin-left: 15px">No music have been uploaded yet under this category.</p>';
    }
}

?>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Music</title>

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
                <li>
                    <a href="addmusic.php">
                        <i class="pe-7s-plus"></i>
                        <p>Add Music</p>
                    </a>
                </li>
                <li class="active">
                    <a href="music.php">
                        <i class="pe-7s-music"></i>
                        <p>Music</p>
                    </a>
                </li>
                <li>
                    <a href="livechat">
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
                    <a class="navbar-brand" href="#">Music Library</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="addmusic.php">
                                <p>Add music</p>
                            </a>
                        </li>
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <h3>Encourage Music</h3>
                <div class="row">

                    <?php
                        showMusic($music_records, 'encourage_music');
                    ?>

                </div>

                <h3>Sleeping Music</h3>
                <div class="row">

                    <?php
                        showMusic($music_records, 'sleeping_music');
                    ?>

                </div>

                <h3>Study Mode Music</h3>
                <div class="row">

                    <?php
                    showMusic($music_records, 'study_mode_music');
                    ?>

                </div>

                <h3>Concentration Music</h3>
                <div class="row">

                    <?php
                    showMusic($music_records, 'concentration_music');
                    ?>

                </div>

                <h3>Motivation Music</h3>
                <div class="row">

                    <?php
                    showMusic($music_records, 'motivation_music');
                    ?>

                </div>

                <h3>Entertaining Music</h3>
                <div class="row">

                    <?php
                    showMusic($music_records, 'entertaining_music');
                    ?>

                </div>

                <h3>Relaxation Music</h3>
                <div class="row">

                    <?php
                    showMusic($music_records, 'relaxation_music');
                    ?>

                </div>

                <h3>Music For Meditation</h3>
                <div class="row">

                    <?php
                    showMusic($music_records, 'meditation_music');
                    ?>

                </div>

                <h3>Stress Releasing Music</h3>
                <div class="row">

                    <?php
                    showMusic($music_records, 'stress_releasing_music');
                    ?>

                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">Site Name</a>, all rights reserved
                </p>
            </div>
        </footer>

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
