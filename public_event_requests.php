<?php
    require_once 'includes/header.php';
    require_once 'includes/convert_tools.php'
?>

<?php
    $user_id = $_SESSION['user_id'];
    if ($_SESSION['user_roleid'] != 0) {
        // CHECK: users who are not superadmins can't view public event requests
        header("location: public_event_requests.php?error=invalidrole=".$_SESSION['user_roleid']);
        exit();
    }

    // update public event that has been approved
    if (isset($_GET['eventId']))
    {
        $rid = $_GET['eventId'];
        $query = "UPDATE event SET event.eventPrivacy = 0 WHERE event.eventid = $rid";
        $result = mysqli_query($db, $query);
    }

    // Profiles List
    $query ="SELECT * FROM event WHERE eventPrivacy = 3";
    $result = mysqli_query($db, $query);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        // TABLE: column names
        $display_block = "
        <table class=\"center\" cellpadding=3 cellspacing=1 border=1>
        <th>Event</th>
        <th>Category</th>
        <th>Description</th>
        <th>Date</th>
        <th>Time</th>
        <th>Location</th>
        <th>Contact Phone Number</th>
        <th>Contact Email</th>
        </tr>";

        while($event_info = mysqli_fetch_array($result)) {
            // FETCH: individual public event
            $event_id = $event_info['eventId'];
            $event_name= $event_info['eventName'];
            $event_category = $event_info['eventCategory'];
            $event_description = $event_info['eventDescription'];
            $event_date = $event_info['eventDate'];
            $event_time = time_slot($event_info['eventTime']);
            $event_location = fetch_location($db ,$event_info['eventLocationId']);
            $event_phone = $event_info['eventContactPhone'];
            $event_email = $event_info['eventContactEmail'];
            
            // TABLE: fill the table with public events, click approves a public event
            $display_block .= "
            <tr>
            <td><strong>$event_name</strong></a><br>
            <td><strong>$event_category</strong></a><br>
            <td><strong>$event_description</strong></a><br>
            <td><strong>$event_date</strong></a><br>
            <td><strong>$event_time</strong></a><br>
            <td><strong>$event_location</strong></a><br>
            <td><strong>$event_phone</strong></a><br>
            <td><strong>$event_email</strong></a><br>
            <td><a href=\"public_event_requests.php?eventId=$event_id\">Approve</a>
            </tr>";
        }
        // TABLE: end
        $display_block.= "</table>";
    } else {
        $display_block = "<p><em>No event requests to display.</em><p>";
    }

?>

<html>
    <head>
        <title> Public Event Requests </title>
    </head>
    <body>
        <div>
            <h1> Public Event Requests </h1>
            <?php print $display_block; ?>
        </div>
    </body>
</html>