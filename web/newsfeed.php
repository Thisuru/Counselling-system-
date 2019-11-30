<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/18/19
 * Time: 6:12 PM
 */

require ('utils/database_api.php');

$newslist = getAllNews($link);

?>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Generate News</title>

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

    <style>
        .table-borderless > tbody > tr > td,
        .table-borderless > tbody > tr > th,
        .table-borderless > tfoot > tr > td,
        .table-borderless > tfoot > tr > th,
        .table-borderless > thead > tr > td,
        .table-borderless > thead > tr > th {
            border: none;
        }
    </style>
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
                <li class="active">
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

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="/logout.php">
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
                                    <table class="table table-hover table-borderless">
                                        <?php
                                        for ($i = 0; $i < count($newslist); $i++) {
                                            echo "<div class=\"row\"><tr>
                                                    <td>
                                                        <table class='table'>
                                                            <tr>
                                                                <td width='100px' rowspan='2'><img style='width: 64px' src='./uploads/".$newslist[$i]->getPhotoPath()."'></td>
                                                                <td><div class='col-md-7'>".$newslist[$i]->getAdminName()."(".$newslist[$i]->getAdminEmail().")</div>
                                                                <div class='col-md-5'>".$newslist[$i]->getDateTime()."</div></td>
                                                            </tr>
                                                            <tr>
                                                                <td><div class='col-md-12'>".$newslist[$i]->getDescription()."</div></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                  </tr></div>
                                                ";
                                        }
                                        ?>
                                    </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</div>


        <footer class="footer">
            <div class="container-fluid">
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">Site Name</a>, All rights reserved
                </p>
            </div>
        </footer>

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