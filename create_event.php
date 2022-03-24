<?php
    require_once 'includes/header.php';
?>

<div>
    <h1> Create Event </h1>

    <form action="includes/create_event-inc.php" method="post">
            <input type="text" name="eventName" placeholder="name">
            <button type="submit" name="submit">Create event</button>
    </form>
</div>

<?php
    require_once 'includes/footer.php';
?>
