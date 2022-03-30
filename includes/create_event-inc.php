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
        $event_location = $_POST['eventLocation'];
        $event_category = $_POST['eventCategory'];
        $event_date = $_POST['eventDate'];
        $event_time = $_POST['eventTime'];
        $event_privacy = $_POST['eventPrivacy'];
        $event_description = $_POST['eventDescription'];

        // CHECK: empty fields
        if (empty($event_name)) {
            // is eventName field empty
            header("location: ../create_event.php?error=emptyfield&eventName=".$event_name);
            exit();

        } elseif (empty($event_location)) {
            // is eventLocation field empty
            header("location: ../create_event.php?error=emptyfield&eventLocation=".$event_location);
            exit();       
        } elseif (empty($event_category)) {
            // is eventCategory field empty
            header("location: ../create_event.php?error=emptyfield&eventCategory=".$event_category);
            exit();
        } elseif (empty($event_date)) {
             // is eventDate field empty
             header("location: ../create_event.php?error=emptyfield&eventDate=".$event_date);
             exit();
        } elseif (empty($event_time)) {
             // is eventTime field empty
             header("location: ../create_event.php?error=emptyfield&eventTime=".$event_time);
             exit();
        } elseif (empty($event_privacy)) {
            // is eventPrivacy field empty
            header("location: ../create_event.php?error=emptyfield&eventPrivacy=".$event_privacy);
            exit();
        } elseif (empty($event_description)) {
            // is eventDescription field empty
            header("location: ../create_event.php?error=emptyfield&eventDescription=".$event_description);
            exit();

        // CREATING THE EVENT
        } else {
            // CHECK: compare location
            $query = "SELECT eventLocation FROM event WHERE eventLocation = ?"
            $stmt = mysqli_stmt_init($db);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                header("location: ../create_event.php?error=sqlerror");
            } else {
                mysqli_stmt_bind_param($stmt, 's', $event_location);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                if ($row = mysqli_fetch_assoc($stmt)) {
                    // found an event with the same location
                    // compare date
                    if ($event_date == $row['eventDate']) {
                        if ($evemt_time == $row['eventTime']) {
                            header("location: ../create_event.php?error=timetaken");
                        }
                    }
                }
            }

        }
?>