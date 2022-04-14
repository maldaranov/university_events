<?php
    if (isset($_POST['submit'])) {
        // CONNECT
        session_start();
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
    $event_phone = $_POST['eventPhone'];
    $event_email = $_POST['eventEmail'];
    $event_privacy = $_POST['eventPrivacy'];
    $event_rsoName = $_POST['eventRsoName'];
    $event_location = $_POST['eventLocation'];
    $event_description = $_POST['eventDescription'];
    $event_univId = $_SESSION['user_univid'];
    $event_locationId = NULL;
    $event_rsoId = NULL;

    $location_latitude = 1.1;
    $location_longitude = 1.1;
    $location_name = NULL;

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
    } elseif (($event_privacy == 3) && empty($event_rsoName)) {
        // is eventRsoName field empty when RSO privacy is chosen
        header("location: ../create_event.php?error=emptyfield&eventRsoName=".$event_rsoName);
        exit();       
    } elseif (empty($event_location)) {
        // is eventLocation field empty
        header("location: ../create_event.php?error=emptyfield&eventLocation=".$event_location);
        exit();
    
    // CHECK: is RSO event being created by the admin who owns that RSO
    // SAVE: RSO ID
    } elseif (($event_privacy == 3) && !empty($event_rsoName)) {
        $query = "SELECT rsoId, rso_active FROM rso WHERE rsoName = ? AND ownerId = ?";
        $stmt = mysqli_stmt_init($db); // $stmt: initialize
        if (!mysqli_stmt_prepare($stmt, $query)) { // $stmt: prepare
            header("location: ../create_event.php?error=sqlerror1");
        } else {
            mysqli_stmt_bind_param($stmt, 'ss', $event_rsoName, $_SESSION['user_id']); // $stmt: bind needed parameters
            mysqli_stmt_execute($stmt); // $stmt: execute
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                // CHECK: inactive RSO can't create events
                if ($row['rso_active'] == 0) {
                    header("location: ../create_event.php?error=rso_inactive=".$row['rso_active']);
                    exit();
                }
                // save rsoId
                $event_rsoId = $row['rsoId'];
            } else {
                // cannot create an RSO event for an RSO that admin doesn't own
                header("location: ../create_event.php?error=permissiondenied&not_admin_of_rso=".$event_location);
                exit();
            }
        }
    } 

    // CREATING THE EVENT
    // CHECK: create location if does not exist
    $query = "SELECT locationId FROM location WHERE locationAddress = ?";
    $stmt = mysqli_stmt_init($db); // $stmt: initialize
    if (!mysqli_stmt_prepare($stmt, $query)) { // $stmt: prepare
        header("location: ../create_event.php?error=sqlerror2");
    } else {
        mysqli_stmt_bind_param($stmt, 's', $event_location); // $stmt: bind needed parameters
        mysqli_stmt_execute($stmt); // $stmt: execute
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            // save locationId, locationLatitude, and locationLongitude
            $event_locationId = $row['locationId'];
            $location_latitude = $row['locationLatitude'];
            $location_longitude = $row['locationLongitude'];;
        } else {
            // location doesn't exist, create new location
            $query = "INSERT INTO location (locationId, locationAddress, locationLatitude, locationLongitude) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($db);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                header("location: ../create_event.php?error=sqlerror3");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, 'isdd', $event_locationId, $event_location, $location_latitude, $location_longitude); // FIXME: insert proper geo data
                mysqli_stmt_execute($stmt); // $stmt: execute
                $event_locationId = mysqli_insert_id($db);
            }
        }

        // CHECK: time conflict
        $query = "SELECT eventLocationId AND eventDate AND eventTime FROM event WHERE eventLocationId = ? AND eventDate = ? AND eventTime = ?";
        $stmt = mysqli_stmt_init($db); // $stmt: initialize
        if (!mysqli_stmt_prepare($stmt, $query)) { // $stmt: prepare {
            header("location: ../create_event.php?error=sqlerror4");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 'isi', $event_locationId, $event_date, $event_time); // $stmt: bind needed parameters
            mysqli_stmt_execute($stmt); // $stmt: execute
            mysqli_stmt_store_result($stmt); // $stmt: store result into internal buffer
            $rowCount = mysqli_stmt_num_rows($stmt); // buffer: count rows
            // location, date, time match found
            if ($rowCount > 0) {
                header("location: ../create_event.php?error=datetimetaken");
                exit();

            } else {
                // CREATE EVENT
                $event_privacy--;   // properly offset the privacy variable
                if ($event_privacy == 0) $event_privacy = 3; // public events are not approved yet (privacy 3)
                $query = "INSERT INTO event (eventName, eventCategory, eventDescription, eventDate, eventTime, eventLocationId, eventContactPhone, eventContactEmail, eventUnivId, eventPrivacy, eventRsoId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($db);
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    header("location: ../create_event.php?error=sqlerror5");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, 'ssssiissiii', $event_name, $event_category, $event_description, $event_date, $event_time, $event_locationId, $event_phone, $event_email, $event_univId, $event_privacy, $event_rsoId);
                    if (mysqli_stmt_execute($stmt)) {
                        header("location: ../create_event.php?success=event_created");
                        exit();
                    } else {
                        header("location: ../create_event.php?error=unexpectederror");
                        exit();
                    }
                }
            }
        }
    }
?>