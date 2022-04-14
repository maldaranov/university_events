<?php
    require_once 'includes/header.php';
?>

<div>
    <h1> Create RSO </h1>

    <form action="includes/create_rso-inc.php" method="post">
            <!-- RSO name input -->
            <label class="required" for="eName"> RSO name: </label>
            <input id="rName" type="text" required size=30 name="rsoName" placeholder="name">
            <p><button type="submit" name="submit">CREATE</button></p>
            
    </form>
</div>

