<?php
    if (isset($_POST['submit'])) {
        // CONNECT
        require 'server.php';
    } elseif ($_SESSION['user_roleid'] != 1) {
        // CHECK: admins can create events
        header("location: ../create_event.php?error=permissiondenied_create_event=".$_SESSION['user_roleid']);
        exit();
    }

        // INPUT
        $event_name = $_POST['eventName'];
        $event_category = $_POST['eventCategory'];
        $event_date = $_POST['eventDate'];
        $event_time = $_POST['eventTime'];
        $event_phone = $_POST['eventtPhone'];
        $event_email = $_POST['eventtEmail'];
        $event_privacy = $_POST['eventPrivacy'];
        $event_rsoName = $_POST['eventtRsoName'];
        $event_location = $_POST['eventLocation'];
        $event_description = $_POST['eventDescription'];
        $eventUnivId;

        // CHECK: empty fields
        if (empty($event_name)) {
            // is eventName field empty
            header("location: ../create_event.php?error=emptyfield&eventName=".$event_name);
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
        } elseif (empty($event_phone)) {
            // is eventPhone field empty
            header("location: ../create_event.php?error=emptyfield&eventPhone=".$event_phone);
            exit();
        } elseif (empty($event_email)) {
            // is eventEmail field empty
            header("location: ../create_event.php?error=emptyfield&eventemail=".$event_email);
            exit();
        } elseif (empty($event_privacy)) {
            // is eventPrivacy field empty
            header("location: ../create_event.php?error=emptyfield&eventPrivacy=".$event_privacy);
            exit();
        } elseif (($event_privacy == 2) && empty($event_rsoName)) {
            // is eventRsoName field empty when RSO privacy is chosen
            header("location: ../create_event.php?error=emptyfield&eventRsoName=".$event_rsoName);
            exit();       
        } elseif (empty($event_location)) {
            // is eventLocation field empty
            header("location: ../create_event.php?error=emptyfield&eventLocation=".$event_location);
            exit();
        
        // CHECK: is RSO event being created by the admin who owns that RSO
        } elseif (($event_privacy == 2) && !empty($event_rsoName)) {
            $query = "SELECT * FROM rso WHERE rsoName = ? AND ownerId = ?";
            $stmt = mysqli_stmt_init($db); // $stmt: initialize
            if (!mysqli_stmt_prepare($stmt, $query)) { // $stmt: prepare
                header("location: ../create_event.php?error=sqlerror");
            } else {
                mysqli_stmt_bind_param($stmt, 'ss', $event_rsoName, $_SESSION['user_id']); // $stmt: bind needed parameters
                mysqli_stmt_execute($stmt); // $stmt: execute
                mysqli_stmt_store_result($stmt); // $stmt: store result inti internal buffer
                $rowCount = mysqli_stmt_num_rows($stmt); // buffer: count rows
                if ($rowCount < 1) {
                    // cannot create an RSO event for an RSO that admin doesn't own
                    header("location: ../create_event.php?error=permissiondenied&not_admin_of_rso=".$event_location);
                }
            }
        // CREATING THE EVENT
        } else {
            // CHECK: compare location->date->time
            $query = "SELECT * FROM event WHERE eventLocation = ?";
            $stmt = mysqli_stmt_init($db);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                header("location: ../create_event.php?error=sqlerror");
            } else {
                mysqli_stmt_bind_param($stmt, 's', $event_location);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                // CHECK: location
                if ($row = mysqli_fetch_assoc($stmt)) {
                    // CHECK: date
                    if ($event_date == $row['eventDate']) {
                        // CHECK: time
                        if ($evemt_time == $row['eventTime']) {
                            header("location: ../create_event.php?error=timetaken");
                        }
                    }
                // if time slot is available at a given location and date, create the event
                } else {
                    $query = "INSERT INTO event (eventName, eventLocation, eventCategory, eventDate, eventTime, eventPrivacy, eventDescription) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($db);
                    if (!mysqli_stmt_prepare($stmt, $query)) {
                        header("location: ../create_event.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "ssssiis", $event_name, $event_location, $event_category, $event_date, $event_time, $event_privacy, $event_description);
                        mysqli_stmt_execute($stmt);
                        header("location: ../event_page.php?success=eventcreated");
                    }
                }
            }

        }
?>