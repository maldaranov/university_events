<?php
    if (isset($_POST['submit'])) {
        // CONNECT
        require 'server.php';
    } elseif ($_SESSION['sessionRole'] != 0) {
        // CHECK: users who are not superadmins can't create university profiles
        header("location: ../create_university_profile.php?error=invalidrole=".$_SESSION['sessionRole']);
        exit();
    }

        // INPUT
        $univ_name = $_POST['univName'];
        $univ_location = $_POST['univLocation'];
        $univ_description = $_POST['univDescription'];
        $univ_num_students = $_POST['univNumStudents'];
        $univ_tag = $_POST['univTag'];
        $univ_picture= $_POST['univPicture'];
    
        // CHECK: empty fields
        if (empty($univ_name)) {
            // is university Name field empty
            header("location: ../create_university_profile.php?error=emptyfield&univName=".$univ_name);
            exit();

        } elseif (empty($univ_location)) {
            // is university Location field empty
            header("location: ../create_university_profile.php?error=emptyfield&univLocation=".$univ_location);
            exit();       
        } elseif (empty($univ_description)) {
            // is university description field empty
            header("location: ../create_university_profile.php?error=emptyfield&univDescription=".$univ_description);
            exit();
        } elseif (empty($univ_num_students)) {
             // is university number students empty
             header("location: ../create_university_profile.php?error=emptyfield&univNumStudents=".$univ_num_students);
             exit();
        } elseif (empty($univ_tag)) {
             // is university tag field empty
             header("location: ../create_university_profile.php?error=emptyfield&univTag=".$univ_tag);
             exit();
        } elseif (empty($univ_picture)) {
            // is university picture field empty
            header("location: ../create_university_profile.php?error=emptyfield&univPicture=".$univ_picture);
            exit();

        // Create University Profile
        } else {
            // CHECK: compare univ Name
            $query = "SELECT * FROM university WHERE univName = ?";
            $stmt = mysqli_stmt_init($db);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                header("location: ../create_university_profile.php?error=sqlerror");
            } else {
                mysqli_stmt_bind_param($stmt, 's', $univ_name);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                
                $query = "INSERT INTO university (univName, univLocation, univDescription, univNumStudents, univTag, univPicture) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($db);
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    header("location: ../create_university_profile.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "sssiss", $univ_name, $univ_location, $univ_description, $univ_num_students, $univ_tag, $univ_picture);
                    mysqli_stmt_execute($stmt);
                    header("location: ../create_university_profile.php?success=unviersityprofilecreated");
                }
            }
        }
?>