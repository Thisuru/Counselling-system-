<?php
session_start();
require ('utils/database_api.php');

// if($_SESSION['patient'] == null && $_SESSION['counselor'] == null){
//     header("location: 404.php");
//     exit();
// }
// if($_SESSION['patient'] == null){
//     $user = $_SESSION['counselor'];
// }
// if($_SESSION['counsellor'] == null){
//     $user = $_SESSION['patient'];
// }




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

        <script>

            var messages;
            var messagecount = 0;

            function sendMessage(){
                var message = document.getElementById("message").value;
                // var sender = "<?php 
                // if($_SESSION['patient'] == null){
                //     echo "Counsellor  ";
                // } else{

                //     echo "Patient ";

                // }?>";

               
                console.log(sender)
                    var patientData = JSON.parse(localStorage.getItem('testObject'));
                    var counselorData = JSON.parse(localStorage.getItem('counselorObject'));
                    var sender = ""
                    if(patientData === null){
                        sender = counselorData['name']
                       
                    }

                    if(counselorData === null){
                        sender = patientData['name']
                    }

	                message = "<b>"+sender+": </b>" + " " + message;
                   




                $.ajax({
                    type: "POST",
                    url: 'utils/chat_api.php',
                    data: {counsellor: sender, patient: sender, message: message},
                    success: function(data){
                        console.log('SUCCESS' + data);
                        readMessages();
                    },
                    fail: function (error) {
                        console.log(error);
                    }
                });
            }

            function checkMessageHistory() {

                var userData = JSON.parse(localStorage.getItem('testObject'));
	                var patient = userData['name']
                    var sender = '' 

                window.setInterval(function(){
                    readMessages();
                }, 5000);

            }

            function readMessages(){
                    var patientData = JSON.parse(localStorage.getItem('testObject'));
                    var counselorData = JSON.parse(localStorage.getItem('counselorObject'));
                    var sender = ""
                    if(patientData === null){
                        sender = counselorData['name']
                    }

                    if(counselorData === null){
                        sender = patientData['name']
                    }

	                
                   
        
                $.ajax({
                    type: "POST",
                    url: 'utils/chat_api.php',
                    data: {counsellor: sender, patient: sender, get: 'get'},
                    success: function(data){
                        console.log(data)
                        if (messagecount < data.length) {
                            messages = data;
                            console.log(data);

                            for (var i = messagecount; i < data.length; i++) {
                                var node = document.createElement("p");
                                var message = data[i].message;
                                node.innerHTML = message;
                                document.getElementById("messagearea").appendChild(node);
                            }
                            messagecount = data.length;
                        }
                    }
                });
            }

            checkMessageHistory();

        </script>

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
                    <li>
                        <a href="music.php">
                            <i class="pe-7s-music"></i>
                            <p>Music</p>
                        </a>
                    </li>
                    <li class="active">
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

                            <input id="log_out" type="button" class="Button" onclick="logout()"  value="Logout" />
                            
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
                            <div class="card" style="overflow-y: scroll; height: 60%">
                                <div class="header">
                                    <h4 class="title">Name</h4>
                                </div>
                                <div id="messagearea" class="content">
<!--                                    <p><b>Tharindu: </b> Hi</p>-->
<!--                                    <p><b>Me: </b> Hello</p>-->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Message</label>
                                        <input id="message" name="message" type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <button name="send" type="button" onclick="sendMessage()" class="btn btn-info btn-fill pull-right">Send</button>
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

    <script>readMessages();</script>

    </html>

<?php
/**
 * Created by PhpStorm.
 * User: aparna_ravihari
 * Date: 5/19/19
 * Time: 11:52 AM
 */

?>

<script>
function logout(){
    localStorage.clear();
            $.ajax({
                    type: "POST",
                    url: 'utils/log_out.php',
                    data: {
                        "logout" : "1",
                    },
                    success: function(res){
                      
							location.href = "login.php";
						
    
                    }
                });

}

</script>