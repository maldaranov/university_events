<?php
    require_once 'includes/header.php';
?>

<?php
    // logs the user out if "logout button was clicked
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: login.php");
    }

    if (isset($_SESSION['sessionId'])) {
        echo "id: ".$_SESSION['sessionId']."<br>username: ".$_SESSION['sessionUser']."<br>Role: ".$_SESSION['sessionRole'];
    } else {
        header("Location: login.php");
    }
?>

<?php
    require_once 'includes/footer.php';
?>
