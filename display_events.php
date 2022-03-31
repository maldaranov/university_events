<?php
    require_once 'includes/header.php';


mysqli_select_db($db, "university_events") or die(mysqli_error("could not connect"));
$userRole = $_SESSION['sessionRole'];

//gather the events

// if ($userRole == 0) // superadmin
// {
//     $get_events = "SELECT * FROM event WHERE eventPrivacy == ";
// }
// else if ($userRole == 1) // admin
// {

// }
// else // student
// {

// }

$get_events = "SELECT * FROM event";

if (!$result = mysqli_query($db, $get_events))
    echo "failed here";
$rowcount = mysqli_num_rows($result);

if ($rowcount < 1) {
   //there are no events, so say so
   $display_block = "<P><em>No events exist.</em></p>";
} else {
   //create the display string
   $display_block = "
   <table cellpadding=3 cellspacing=1 border=1>
   <tr>
   <th>Event Name</th>
   <th>Event Location</th>
   <th>Event Category</th>
   <th>Event Date</th>
   <th>Event Time</th>
   <th>Event Description</th>
   </tr>";

    while ($event_info = mysqli_fetch_array($result)) {

       $event_id = $event_info['eventId'];
       $event_location = $event_info['eventLocation'];
       $event_category = $event_info['eventCategory'];
       $event_date = $event_info['eventDate'];
       $event_time = $event_info['eventTime'];
       $event_desc = $event_info['eventDescription'];
       $event_title = $event_info['eventName'];
       // $event_create_time = $event_info['fmt_event_create_time'];
       // $event_owner = stripslashes($event_info['event_owner']);

       //get number of posts
       $get_num_posts = "select count(eventId) from event
            where eventId = $event_id";
        if (!$get_num_posts_res = mysqli_query($db, $get_num_posts))
        {
            echo "failed";
            exit();
        }

       //add to display
       $display_block .= "
       <tr>
       <td><a href=\"event_page.php?eventId=$event_id\">
       <strong>$event_title</strong></a><br>
       <td><strong>$event_location</strong></a><br>
       <td><strong>$event_category</strong></a><br>
       <td><strong>$event_date</strong></a><br>
       <td><strong>$event_time</strong></a><br>
       <td><strong>$event_desc</strong></a><br>
       </tr>";
   }


   //close up the table
   $display_block .= "</table>";
}
?>
<html>
<head>
<title>events in My Forum</title>
</head>
<body>
<h1>events in My Forum</h1>
<?php print $display_block; ?>
<P>Would you like to <a href="create_event.php">add a event</a>?</p>
</body>
</html>

<?php
    require_once 'includes/footer.php';
?>
