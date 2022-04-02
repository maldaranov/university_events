<?php
    require_once 'includes/header.php';
?>

<div>
    <h1> Create RSO </h1>

    <form action="includes/create_rso-inc.php" method="post">
            <!-- RSO name input -->
            <label for="eName"> Event name: </label>
            <input id="eName" type="text" required size=30 name="eventName" placeholder="name">
            
    </form>
</div>

<?php
    require_once 'includes/footer.php';
?>
