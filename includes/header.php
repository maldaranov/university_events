<?php
    session_start();
    require_once 'includes/server.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css?v=51">
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="index.php"> Home </a></li>
                    <li><a href="rso_list.php"> RSOs </a><li>
                    <li><a href="university_list.php"> Universities </a></li>
                    <li><a href="create_rso.php"> Create RSO </a></li>
                    <!-- admins can create RSOs and events-->
                    <?php if (isset($_SESSION['user_roleid']) && (($_SESSION['user_roleid'] == 0) || ($_SESSION['user_roleid'] == 1))) { ?>
                        <li><a href="create_event.php"> Host Event </a></li>
                    <?php } ?>
                    <?php if (isset($_SESSION['user_roleid']) && ($_SESSION['user_roleid'] == 0)) { ?>
                        <li><a href="create_university_profile.php"> Create University </a></li>
                        <li><a href="public_event_requests.php"> Approve Events </a></li>
                    <?php } ?>
                    <li><a href="index.php?logout='1'"> Log Out </a></li>
                </ul>
            </nav>
        </header>
