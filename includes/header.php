<?php
    session_start();
    require_once 'includes/server.php';
    require_once 'register-inc.php' // for logout functionality
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Document </title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="index.php"> Home </a></li>
                    <!-- show the "create event" button only to admins of RSOs-->
                    <?php if (isset($_SESSION['sessionId']) && ($_SESSION['sessionRole'] = 3)) { ?>
                        <li><a href="create_event.php"> Host Event </a></li>
                    <?php } ?>
                    <li class = "right"><a href="index.php?logout='1'"> Log Out </a></li>
                </ul>
            </nav>
        </header>
