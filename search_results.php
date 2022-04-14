<?php
    require_once 'includes/header.php';
    require_once 'includes/convert_tools.php';
    require_once 'includes/event_table_generate.php';
?>

<div>
    <h1> Events </h1>
    <form action="search_results.php" method="post">
            <input type="text" name="event_name" placeholder="event name">
            <button type="submit" name="search">SEARCH</button>
    </form>
</div>

<?php
    if (isset($_POST['search'])) {
        $user_id = $_SESSION['user_id'];
        $user_univId = $_SESSION['user_univid'];
        $search = mysqli_real_escape_string($db, $_POST['event_name']);
        // FETCH: public events
        $query = "SELECT * FROM event WHERE eventPrivacy = 0 AND (eventName LIKE '%$search%' OR eventCategory LIKE '%$search%' OR eventDescription LIKE '%$search%')";
        $display_block_public = display_block_generate($db, $query);

        // FETCH: private events
        $query = "SELECT * FROM event WHERE eventPrivacy = 1 AND eventUnivId = $user_univId AND (eventName LIKE '%$search%' OR eventCategory LIKE '%$search%' OR eventDescription LIKE '%$search%')";
        $display_block_private = display_block_generate($db, $query);

        // FETCH: RSO events
        $query = "SELECT DISTINCT * FROM event LEFT JOIN rso_members ON rso_members.rsoId = event.eventRsoId WHERE rso_members.userId = $user_id AND (eventName LIKE '%$search%' OR eventCategory LIKE '%$search%' OR eventDescription LIKE '%$search%')";
        $display_block_rso = display_block_generate($db, $query);
    }
?>

<html>
    <head>
        <title> University Events </title>
    </head>
    <body>
        <div>
        <h2> Public Events </h2>
        <?php print $display_block_public; ?>
        <h2> Private Events </h2>
        <?php print $display_block_private; ?>
        <h2> RSO events </h2>
        <?php print $display_block_rso; ?>
        </div>
    </body>
</html>