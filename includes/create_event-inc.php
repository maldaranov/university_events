<?php
    if (isset($_POST['submit'])) {
        // CONNECT
        require 'server.php';
    } elseif ($_SESSION['sessionRole'] == 2) {
        // CHECK: students who are not admins can't host events
        header("location: ../create_event.php?error=invalidrole=".$_SESSION['sessionRole']);
        exit();
    }

        // INPUT
        $event_name = $_POST['eventName'];
        $event_category = $_POST['eventCategory'];
        $event_datetime = $_POST['eventDatetime'];
        $event_description = $_POST['eventDescription'];
        $event_privacy = $_POST['eventPrivacy'];

        // CHECK: empty fields
        if (empty($event_name)) {
            // is eventName field empty
            header("location: ../create_event.php?error=emptyfield&eventName=".$event_name);
            exit();
        } elseif (empty($event_category)) {
            // is eventCategory field empty
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
        } elseif (empty($event_privacy)) {
            header("location: ../create_event.php?error=emptyfield&eventPrivacy=".$event_privacy);
            exit();

        // CHECK: time
        } else {

        }
?>