<?php
    require_once 'includes/header.php';
?>

<div>
    <h1> Create Event </h1>

    <form action="includes/create_event-inc.php" method="post">
            <input type="text" size=30 name="eventName" placeholder="name">
            <input type="text" name="type" placeholder="type">
            <textarea name="description" rows=8 cols=30 wrap=virtual></textarea>
            <input type="text" name="category" placeholder="cateegory">
            <input type="datetime" name="datetime" placeholder="date and time">
            <button type="submit" name="submit">Create event</button>
    </form>
</div>

<?php
    require_once 'includes/footer.php';
?>
