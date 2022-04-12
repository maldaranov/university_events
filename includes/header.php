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
                    <!-- admins can create RSOs and events-->
                    <?php if (isset($_SESSION['user_roleid']) && (($_SESSION['user_roleid'] == 0) || ($_SESSION['user_roleid'] == 1))) { ?>
                        <li><a href="create_event.php"> Host Event </a></li>
                        <li><a href="create_rso.php"> Create RSO </a></li>
                    <?php } ?>
                    <?php if (isset($_SESSION['user_roleid']) && ($_SESSION['user_roleid'] == 0)) { ?>
                        <li><a href="create_university_profile.php"> Create University </a></li>
                    <?php } ?>
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <li><a href="display_rsos.php"> RSOs </a></li>
                        <li><a href="display_university_profile.php"> Universities </a></li>
                        <li><a href="index.php?logout='1'"> Log Out </a></li>
                    <?php } ?>
                </ul>
            </nav>
        </header>
