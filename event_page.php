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
    // $event_location = $event_info['eventLocation'];
    $event_category = $event_info['eventCategory'];
    $event_date = $event_info['eventDate'];
    $event_time = $event_info['eventTime'];
    $event_privacy = $event_info['eventPrivacy'];
    $event_description = $event_info['eventDescription'];

    $display_block = "
    <h1 style=text-align:center>$event_name</h1>
    <p align=center> Category: $event_category </p>
    <p align=center> Date: $event_date </p>
    <p align=center> Category: $event_time </p>
    <p align=center> Privacy: $event_privacy </p>
    <p align=center> Description: $event_description </p>
    ";
     print $display_block;
?>

<h2 style="text-align:center">Comments</h2>
<?php
    $eid = $_GET['eventId'];
    $get_comment = "SELECT * FROM event_comment WHERE comment_eventId = $eid";
    $result = mysqli_query($db, $get_comment);

    while($row = mysqli_fetch_object($result))
    {
?>
    <div class="comment" style='text-align:left'>
        <p align=center>By: <?php echo $row->comment_userName; ?></p>
        <p align=center>
        <?php echo $row->comment_msg; ?>
        </p>
    </div>
<?php
    }
?>

// Comment box
<h3 style="text-align:center">Leave a comment:</h3>
<form action="insertcomment.php" method="post">
<input type="hidden" name="eventid" value="<?php echo $_GET['eventId']; ?>"/>
<textarea name="comment" rows="10" cols="100"></textarea>
<input type="submit" />
</form>

<?php
    require_once 'includes/footer.php';
?>