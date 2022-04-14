<?php
    require_once 'includes/header.php';
    require_once 'includes/convert_tools.php';
    include 'includes/comment-inc.php';
?>

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style_comment.css">

<?php
    $eid = $_GET['eventId'];
    $get_event = "SELECT * FROM event WHERE eventId = $eid";
    $result = mysqli_query($db, $get_event);
    $event_info = mysqli_fetch_array($result);
    $event_locId = $event_info['eventLocationId'];

    // $query = "SELECT locationAddress FROM event LEFT JOIN location ON $event_locId = location.locationId";
    // $result = mysqli_query($db, $query);
    // $address_info = mysqli_fetch_array($result);
    // $address = $address_info['locationAddress'];

    // FETCH: individual event
    $event_id = $event_info['eventId'];
    $event_name= $event_info['eventName'];
    $event_category = $event_info['eventCategory'];
    $event_description = $event_info['eventDescription'];
    $event_date = $event_info['eventDate'];
    $event_time = time_slot($event_info['eventTime']);
    $event_locId = $event_info['eventLocationId'];
    $event_phone = $event_info['eventContactPhone'];
    $event_email = $event_info['eventContactEmail'];
    $event_privacy = privacy($event_info['eventPrivacy']);

    // FETCH: grab address for map iframe
    $address = fetch_location($db, $event_locId);

    $display_block = "
    <h1 style=text-align:center> $event_name </h1>
    <p align=center> Category: $event_category </p>
    <p align=center> Date: $event_date </p>
    <p align=center> Time: $event_time </p>
    <p align=center> Contact Phone: $event_phone </p>
    <p align=center> Contact Email: $event_email </p>
    <p align=center> Privacy: $event_privacy </p>
    <p align=center> Description: $event_description </p>
    <p align=center> Rating: ".$rate_var['AVG(ratingValue)']."</p>
    ";
     print $display_block;
?>

<!-- Event Rating -->
<h3 style="text-align:center">Rate the event</h3>
<?php
echo "<form action='".rateEvent($db)."' method='post'>
    <input type='hidden' name='rating_eventId' value='".$event_id."'>
    <select id='ratingValue' name='ratingValue'>
        <option value=''></option>
        <option value='1'> 1 </option>
        <option value='2'> 2 </option>
        <option value='3'> 3 </option>
        <option value='4'> 4 </option>
        <option value='5'> 5 </option>
    </select> 
    <p align=center><button type='submit' name='eventRate'>Rate</button></p>
</form>";
?>

<div>
<iframe width="50%" height="300" src="https://maps.google.com/maps?q=<?php echo $address; ?>&output=embed"></iframe>
</div>   

<!-- Comment text box -->
<h3 style="text-align:center">Leave a comment:</h3>
<?php
echo "<form action='".setComments($db)."' method='post'>
    <input type='hidden' name='comment_eventId' value='".$event_id."'>
    <input type='hidden' name='comment_userName' value='".$_SESSION['user_username']."'>
    <input type='hidden' name='comment_datetime' value='".date('Y-m-d H:i:s')."'>
    <textarea name='comment_msg' rows='8' cols='100'></textarea>
    <p align=center><button type='submit' name='commentSubmit'>Comment</button></p>
</form>";

getComments($db);
?>
