<?php
    require_once 'includes/header.php';
?>

<?php
    $currUserId = $_SESSION['user_id'];
    if ($_SESSION['user_roleid'] != 0) {
        // CHECK: users who are not superadmins can't view public event requests
        header("location: ../display_public_requests.php?error=invalidrole=".$_SESSION['user_roleid']);
        exit();
    }

    // update public event that has been approved
    if (isset($_GET['eventId']))
    {
        $rid = $_GET['eventId'];
        $queryx = "UPDATE event
        SET event.eventPrivacy = 0
        WHERE event.eventid = $rid
        ";
        $resultx = mysqli_query($db, $queryx);
    }

    // Profiles List
    $query ="SELECT DISTINCT event.eventId, event.eventName, event.eventCategory, event.eventDescription, event.eventDate, event.eventTime, event.eventLocationId, event.eventRsoId, event.eventContactPhone, event.eventContactEmail, location.locationAddress
    FROM event
    LEFT JOIN location
    ON event.eventLocationId = location.locationId
    LEFT JOIN user
    ON user.userId = $currUserId
    WHERE event.eventUnivId = user.univId AND event.eventPrivacy = 3
    ";
    $result = mysqli_query($db, $query);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        // TABLE: column names
        $display_block = "
        <table cellpadding=3 cellspacing=1 border=1>
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
            // FETCH: individual university
            $event_id = $event_info['eventId'];
            $event_name= $event_info['eventName'];
            $event_category = $event_info['eventCategory'];
            $event_description = $event_info['eventDescription'];
            $event_date = $event_info['eventDate'];
            $event_time = $event_info['eventTime'];
            $event_location = $event_info['locationAddress'];
            $event_phone = $event_info['eventContactPhone'];
            $event_email = $event_info['eventContactEmail'];
            
            // TABLE: fill the table with universities, click sends user to a university page
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
            <td><a href=\"display_public_requests.php?eventId=$event_id\">APPROVE</a>
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
        <h1> Public Event Requests </h1>
        <?php print $display_block; ?>
    </body>
</html>

<?php
    require_once 'includes/footer.php';
?>
