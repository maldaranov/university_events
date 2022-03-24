<?php
    require_once 'includes/header.php';
?>

<?php
    // logs the user out if "logout button was clicked
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['sessionId']);
        unset($_SESSION['sessionUser']);
        unset($_SESSION['sessionRole']);
        header("location: login.php");
    }

    // display the index page iff the user is logged in
    if (isset($_SESSION['sessionId'])) {
        echo "You are logged in!<br>";

        // display event list
        $query = "SELECT * from event";
        $result = mysqli_query($db, $query);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo $row['eventId']." "
                .$row['eventName']." "
                .$row['eventType']." "
                .$row['eventCategory']." "
                .$row['eventDescription']." "
                .$row['eventTime']."<br>";
            }
        }

        /* test session variables
        echo "id: ".$_SESSION['sessionId']."<br>
        username: ".$_SESSION['sessionUser']."<br>
        Role: ".$_SESSION['sessionRole'];
        */

    } else {
        header("location: login.php?error=notloggedin");
    }

?>

<?php
    require_once 'includes/footer.php';
?>

