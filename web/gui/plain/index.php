<?php

$display = "";
$thisFile = __FILE__;

if (!file_exists('../../config/global_config.php'))
{
    header('Location: ../../install/install_programo.php');
}

/** @noinspection PhpIncludeInspection */
require_once('../../config/global_config.php');
/** @noinspection PhpIncludeInspection */
require_once('../../chatbot/conversation_start.php');

$get_vars = (!empty($_GET)) ? filter_input_array(INPUT_GET) : array();
$post_vars = (!empty($_POST)) ? filter_input_array(INPUT_POST) : array();
$form_vars = array_merge($post_vars, $get_vars); // POST overrides and overwrites GET
$bot_id = (!empty($form_vars['bot_id'])) ? $form_vars['bot_id'] : 1;
$say = (!empty($form_vars['say'])) ? $form_vars['say'] : '';
$convo_id = session_id();
$format = (!empty($form_vars['format'])) ? $form_vars['format'] : 'html';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>News Hunter</title>
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="assets/images/favicon_1.ico">


        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
        <link href="assets/plugins/jquery-circliful/css/jquery.circliful.css" rel="stylesheet" type="text/css" />

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/components.css" rel="stylesheet" type="text/css">
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">

    <style type="text/css">
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .topbar .topbar-left {
            background: #3bafda;
            border-bottom: 1px solid #3bafda;
            float: left;
            height: 70px;
            position: relative;
            width: 240px;
            z-index: 1;
        }

        .logo {
            color: white !important;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: .02em;
            line-height: 70px;
        }
        .navbar-default {
            background-color: #3bafda;
            border-radius: 0px;
            border: none;
            margin-bottom: 0px;
        }
        #responses {
            width: 90%;
            min-width: 515px;
            height: auto;
            min-height: 150px;
            max-height: 500px;
            overflow: auto;
            border: 3px inset #666;
            margin-left: auto;
            margin-right: auto;
            padding: 5px;
        }

        #input {
            width: 90%;
            min-width: 535px;
            margin-bottom: 15px;
            margin-left: auto;
            margin-right: auto;
        }

        #convo_id {
            position: absolute;
            top: 10px;
            right: 10px;
            border: 1px solid red;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-shadow: 2px 2px 2px 0 #808080;
            padding: 5px;
            border-radius: 5px;
        }
        .navbar-default {
            background-color: #3bafda;
            border-radius: 0px;
            border: none;
            position: fixed;
            padding-right: 20%;
            margin-bottom: 0px;
        }
        .topbar .topbar-left {
            background: transparent;
            border-bottom: transparent;
            float: left;
            height: 70px;
            position: fixed;
            width: 240px;
            z-index: 1;
        }
        .col-lg-12 {
            z-index: -1;
            position: relative;
            width: 100%;
            padding-top: 50px;
        }
    </style>
</head>
<body class="fixed-center" onload="document.getElementById('say').focus()">
<div id="wrapper">
<div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="" class="logo"><i class="md md-equalizer"></i> <span>News Hunter</span> </a>
                    </div>
                </div>
                <!-- Navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">

                                <span class="clearfix"></span>
                            </div>

                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->
<div class="content">
<div class="row">
<div class="col-sm-12">
<div class="card-box">
<?php
define('HOST','localhost');
define('USER','root');
define('PASS','usbw');
define('DB','chatbot');
    $connection = mysqli_connect(HOST,USER,PASS,DB);

    $query = "Select * from conversation_log";

    $result = mysqli_query($connection,$query);

?>
                            <!-- CHAT -->
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 m-b-20 header-title"><center><b>News Hunter</b></center></h4>

                                    <div class="chat-conversation">
                                        <ul class="conversation-list nicescroll">
                                                <?php
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                            <li class="clearfix odd">
                                                <div class="chat-avatar">
                                                    <img src="assets/images/profile_placeholder.png" alt="Female">
                                                    <i></i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>You</i>
                                                        <p>
                                                <input type="hidden" name="convo_id" id="convo_id" value="<?php echo $convo_id; ?>"/>
                                                <?php echo $row['input']; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="chat-avatar">
                                                    <img src="assets/images/avatar-0.png" alt="Female">
                                                    <i></i>
                                                </div>
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <i>Hunter</i>
                                                        <p>
                                                <input type="hidden" name="bot_id" id="bot_id" value="<?php echo $bot_id; ?>"/>
                                                <?php echo $row['response']; ?>
                                                <!--input type="hidden" name="format" id="format" value="<?php //echo $format; ?>"/>
                                                <div id="responses"><?php //echo $display . '<div id="end">&nbsp;</div>' . PHP_EOL ?></div-->
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>

                            </div> <!-- end col-->
    </div>
<form name="chatform" method="post" action="index.php#end"
      onsubmit="if(document.getElementById('say').value == '') return false;">
    <div id="input">
        <div class="row">
            <div class="col-sm-9 chat-inputbar">
                <input type="text" class="form-control chat-input" placeholder="Enter your text" name="say" id="say" size="70"/>
            </div>
            <div class="col-sm-3 chat-send">
                <input type="submit" class="btn btn-md btn-primary btn-block waves-effect waves-light" name="submit" id="btn_say" value="Ask"/>
            </div>
        </div>
</form>
</div>
</div>

</div>
</div>
</div>
</div>
</body>
</html>
