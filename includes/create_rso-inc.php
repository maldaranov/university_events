<?php
    if (isset($_POST['submit'])) {
        // CONNECT
        session_start();
        require 'server.php';
    }

        // INPUT
        $rso_id = NULL;
        $rso_active = 0;
        $rso_name = $_POST['rsoName'];
        $rso_ownerId = $_SESSION['user_id'];
        $rso_univId = $_SESSION['user_univid'];
        
        // CHECK 1: If RSO already exists then show an error.
        $query = "SELECT rsoId FROM rso WHERE rsoName = ?";
        $stmt = mysqli_stmt_init($db); // $stmt: initialize
        if (!mysqli_stmt_prepare($stmt, $query)) { // $stmt: prepare
            header("location: ../create_rso.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $rso_name); // $stmt: bind needed parameters
            mysqli_stmt_execute($stmt); // $stmt: execute
            mysqli_stmt_store_result($stmt); // $stmt: store result into internal buffer
            $rowCount = mysqli_stmt_num_rows($stmt); // buffer: count rows

            if ($rowCount > 0) {
                // such RSO already exists
                header("location: ../create_rso.php?error=rsoalreadyexists=".$rso_name);
                exit();
            } else {
                // create a new RSO
                $query = "INSERT INTO rso (rso_active, rsoName, ownerId, univId) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($db); // $stmt: initialize
                if (!mysqli_stmt_prepare($stmt, $query)) { // $stmt: prepare
                    header("location: ../register.php?error=sqlerror2");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "isii", $rso_active, $rso_name, $rso_ownerId, $rso_univId); // $stmt: bind needed parameters
                    mysqli_stmt_execute($stmt); // $stmt: execute

                    // INSERT as member
                    $query = "INSERT INTO rso_members (rsoId, userId) VALUES (?, ?)";
                    $stmt = mysqli_stmt_init($db); // $stmt: initialize
                    if (!mysqli_stmt_prepare($stmt, $query)) { // $stmt: prepare
                        header("location: ../register.php?error=sqlerror2");
                        exit();
                    } else {
                         mysqli_stmt_bind_param($stmt, "ii", $rso_id, $rso_ownerId); // $stmt: bind needed parameters
                         mysqli_stmt_execute($stmt); // $stmt: execute
                    }

                    header("location: ../rso_list.php?success=rsocreated");
                    exit();
                }
            }
        }
?>