<?php
    require_once 'includes/header.php';
?>

<?php
    $eid = $_GET['eventId'];
    $get_event = "SELECT * FROM event WHERE eventId = $eid";
    $result = mysqli_query($db, $get_event);
    $event_info = mysqli_fetch_array($result);

    // FETCH: individual event
    $event_id = $event_info['eventId'];
    $event_name= $event_info['eventName'];
    $event_location = $event_info['eventLocation'];
    $event_category = $event_info['eventCategory'];
    $event_date = $event_info['eventDate'];
    $event_time = $event_info['eventTime'];
    $event_privacy = $event_info['eventPrivacy'];
    $event_description = $event_info['eventDescription'];

    $display_block = "
    <h1>$event_name</h1>
    <p> Location: $event_location </p>
    <p> Category: $event_category </p>
    <p> Date: $event_date </p>
    <p> Category: $event_time </p>
    <p> Privacy: $event_privacy </p>
    <p> Description: $event_description </p>
    ";
     print $display_block;
?>

<?php
    require_once 'includes/footer.php';
?>