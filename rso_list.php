<?php
    require_once 'includes/header.php';
?>

<?php
    // CHECK: logged out
    if (isset($_GET['logout'])) {
        session_destroy();
        session_unset();
        header("location: login.php");
    }

    // CHECK: logged in
    if (!isset($_SESSION['user_id'])) {
        header("location: login.php?error=notloggedin");
    } else {
        // ACTION: clicking on "join" next to an RSO will assign the current user to the RSO
        $user_id = $_SESSION['user_id'];
        $user_univId = $_SESSION['user_univid'];
        if (isset($_GET['rsoId']))
        {
            $rid = $_GET['rsoId'];
            $query = "INSERT INTO rso_members (rsoId, userId) VALUES (?, ?)";
            $stmt = mysqli_stmt_init($db); // $stmt: initialize
            if (!mysqli_stmt_prepare($stmt, $query)) {
                header("location: ../rso_list.php?error=sqlerror1");
                exit();
            } else {
                // UPDATE: user joins the RSO
                mysqli_stmt_bind_param($stmt, "ii", $rid, $user_id); // $stmt: bind needed parameters
                mysqli_stmt_execute($stmt); // $stmt: execute
                // UPDATE: activate RSO with 4 students
                    // FETCH: count members in the RSO
                $query = "SELECT * FROM rso_members WHERE rsoId = $rid";
                $result = mysqli_query($db, $query);
                $num_members = mysqli_num_rows($result);
                    // FETCH: get RSO status
                $query = "SELECT rso_active FROM rso WHERE rsoId = $rid";
                $result = mysqli_query($db, $query);
                $row = mysqli_fetch_assoc($result);
                $rso_state = $row['rso_active'];
                    // CHECK: is RSO inactive and number of members is >= 4
                if ($rso_state == 0 && $num_members >= 4) {
                    // UPDATE: activate RSO
                    $query = "UPDATE rso SET rso_active = 1 WHERE rsoId = $rid";
                    $stmt = mysqli_stmt_init($db); // $stmt: initialize
                    mysqli_query($db, $query);
                }
                header("location: rso_list.php?success=rsojoined=".$rid);
            }
        }

        // FETCH: RSOs from the same university as the user
        $query = "SELECT * FROM rso WHERE univId = $user_univId";
        $result1 = mysqli_query($db, $query);
        $rows = mysqli_num_rows($result1);
        if ($rows > 0) {
            // TABLE: column names
            $display_block = "
            <table class=\"center\" cellpadding=3 cellspacing=5 border=1>
            <th>RSO Status</th>
            <th>RSO Name</th>
            </tr>";

            while($rso_info = mysqli_fetch_array($result1)) {
                // FETCH: individual rso
                $rso_id = $rso_info['rsoId'];
                $rso_name= $rso_info['rsoName'];
                if ($rso_info['rso_active'] == 1) {
                    $rso_status = "Active";
                } else {
                    $rso_status = "Inactive";
                }

                // CHECK: user is a member of the rso
                $query = "SELECT * FROM rso_members WHERE rsoId = $rso_id AND userId = $user_id";
                $result2 = mysqli_query($db, $query);
                $rows = mysqli_num_rows($result2);
                // TABLE: fill the table with rsos
                if ($rows != 0) {
                    $display_block .= "
                    <tr>
                    <td><strong>$rso_status</strong></a><br>
                    <td><strong>$rso_name</strong></a><br>
                    <td><strong>Joined</strong></a><br>
                    </tr>"; 
                }  else {
                    $display_block .= "
                    <tr>
                    <td><strong>$rso_status</strong></a><br>
                    <td><strong>$rso_name</strong></a><br>
                    <td><a href=\"rso_list.php?rsoId=$rso_id\">Join</a>
                    </tr>"; 
                }   
            }
            // TABLE: end
            $display_block.= "</table>";
        } else {
            $display_block = "<p><em>No RSOs to display.</em><p>";
        }
    }

    // FETCH: get the user's university name
    $query ="SELECT university.univName FROM university LEFT JOIN user ON university.univId = user.univId WHERE user.userId = $user_id";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result);
    $univ_name = $row['univName'];
?>

<html>
    <head>
        <title> RSOs </title>
    </head>
    <body>
        <div>
            <h1> Registered Student Organizations </h1>
            <h2> at <?php print $univ_name; ?></h2>
            <?php print $display_block; ?>
        </div>
    </body>
</html>