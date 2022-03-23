<?php
    session_start();
    require_once 'includes/server.php';
    require_once 'register-inc.php'
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
                    <li class="home_btn"><a href="index.php"> Home </a></li>
                    <li><a href="index.php"> About </a></li>
                    <li><a href="index.php?logout='1'"> Log Out </a></li>
                </ul>
            </nav>
        </header>
