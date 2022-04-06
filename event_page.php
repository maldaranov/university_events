<?php
    require_once 'includes/header.php';
    include 'includes/event_page-inc.php';
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
    <div class="comment-box" style='text-align:left'>
    <link rel="stylesheet" type="text/css" href="style.css">
        <p align=center>By: <?php echo $row->comment_userName; ?></p>
        <p align=center><?php echo $row->comment_msg; ?></p>
    </div>
<?php
    }
?>

<!-- Comment text box: Need to change hardcoded values to variables -->
<h3 style="text-align:center">Leave a comment:</h3>
<?php
echo "<form action='".setComments($db)."' method='post'>
    <input type='hidden' name='comment_eventId' value='2'>
    <input type='hidden' name='comment_userId' value='2'>
    <input type='hidden' name='comment_userName' value='Anonymous'>
    <input type='hidden' name='comment_datetime' value='".date('Y-m-d H:i:s')."'>
    <textarea name='comment_msg' rows='8' cols='100'></textarea>
    <p align=center><button type='submit' name='commentSubmit'>Comment</button></p>
</form>";

?>
