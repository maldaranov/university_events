<?php
    require_once 'includes/header.php';
?>

<?php
    // LOG OUT
    if (isset($_GET['logout'])) {
        session_destroy();
        session_unset();
        header("location: login.php");
    }

    // CHECK: logged in
    if (!isset($_SESSION['user_id'])) {
        header("location: login.php?error=notloggedin");
    } else {
        $currUserId = $_SESSION['user_id'];
        if (isset($_GET['rsoId']))
        {
            $rid = $_GET['rsoId'];
            $query = "INSERT INTO rso_members (rsoId, userId) VALUES (?, ?)";
            $stmt = mysqli_stmt_init($db);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                header("location: ../display_rsos.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ii", $rid, $currUserId);
                mysqli_stmt_execute($stmt);
            }
        }

        // get all rsos that are part of the university the user is part of
        $query ="SELECT DISTINCT rso.rsoId, rso.rsoName, rso.univId
        FROM rso, user
        WHERE user.userId = $currUserId AND user.univId = rso.univId
        ";
        $result = mysqli_query($db, $query);
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
            // TABLE: column names
            $display_block = "
            <table cellpadding=3 cellspacing=5 border=0>
            <th>RSO Name</th>
            </tr>";

            while($rso_info = mysqli_fetch_array($result)) {
                // FETCH: individual rso
                $rso_id = $rso_info['rsoId'];
                $rso_name= $rso_info['rsoName'];

                // check if user is already part of the RSO
                $query2 ="SELECT DISTINCT rso_members.rsoId
                FROM rso_members, user
                WHERE rso_members.rsoId = $rso_id AND rso_members.userId = $currUserId
                ";
                $result2 = mysqli_query($db, $query2);
                $rows2 = mysqli_num_rows($result2);
                // TABLE: fill the table with rsos
                if ($rows2 != 0) {
                    $display_block .= "
                    <tr>
                    <td><strong>$rso_name</strong></a><br>
                    <td><strong>REGISTERED</strong></a><br>
                    </tr>"; 
                }  else {
                    $display_block .= "
                    <tr>
                    <td><strong>$rso_name</strong></a><br>
                    <td><a href=\"display_rsos.php?rsoId=$rso_id\">JOIN</a>
                    </tr>"; 
                }   
            }

            // TABLE: end
            $display_block.= "</table>";
            } else {
                $display_block = "<p><em>No rsos to display.</em><p>";
            }
    }

    // get the name of the University that the user is part of 
    $query3 ="SELECT university.univName
    FROM university
    LEFT JOIN user
    ON university.univId = user.univId
    WHERE user.userId = $currUserId
    ";
    $result3 = mysqli_query($db, $query3);
    $univ_info = mysqli_fetch_array($result3);
    $univ_name = $univ_info['univName'];
?>

<html>
    <head>
        <title> RSOs </title>
    </head>
    <body>
        <h1> RSOs at <?php print $univ_name; ?></h1>
        <?php print $display_block; ?>
    </body>
</html>

<?php
    require_once 'includes/footer.php';
?>
