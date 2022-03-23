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
        $query = "SELECT * from event";
        $events_result = mysqli_query($db, $query);
        while ($events = mysqli_fetch_assoc($events_result)) {
            echo $events['eventName']."<br";
        }
        /*
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
