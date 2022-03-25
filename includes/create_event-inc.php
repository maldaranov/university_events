<?php
    if (isset($_POST['submit'])) {
        // Add database connection when HOST button is clicked
        require 'server.php';
    } elseif ($_SESSION['sessionRole'] == 2) {
        header("location: ../create_event.php?error=invalidrole=".$_SESSION['sessionRole']);
        exit();
    }

        // store event information
        $event_name = $_POST['eventName'];
        $event_category = $_POST['eventCategory'];
        $event_datetime = $_POST['eventDatetime'];
        $event_description = $_POST['eventDescription'];

        // check for empty fields
        if (empty($event_name)) {
            // is eventName field empty
            header("location: ../create_event.php?error=emptyfield&eventName=".$event_name);
            exit();
        } elseif (empty($event_category)) {
            // is eventCategoryfield empty
            header("location: ../create_event.php?error=emptyfield&eventCategory=".$event_category);
            exit();
        } elseif (empty($event_datetime)) {
             // is eventDatetime field empty
             header("location: ../create_event.php?error=emptyfield&eventDatetime=".$event_datetime);
             exit();
            // is eventDescription field empty
        } elseif (empty($event_description)) {
            header("location: ../create_event.php?error=emptyfield&eventDescription=".$event_description);
            exit();
        }
?>