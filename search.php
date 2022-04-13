<?php
    require_once 'includes/header.php';
?>

<form action="search.php" method="POST">
    <input type="text" name="search" placeholder="Search">
    <button type="submit" name="submit-search"></button>
</form>

<?php
    // Display events that follow same constraints but are like the search 
    if (isset($_POST['submit-search'])) {
                $currUserId = $_SESSION['user_id'];
        $search = mysqli_real_escape_string($db, $_POST['search']);
        $sql = "SELECT DISTINCT event.eventId, event.eventName, event.eventCategory, event.eventDescription, event.eventDate, event.eventTime, event.eventLocationId, event.eventRsoId, event.eventContactPhone, event.eventContactEmail, location.locationAddress
        FROM rso_members
        LEFT JOIN event
        ON rso_members.rsoId = event.eventRsoId
        LEFT JOIN user
        ON rso_members.userId = user.userId
        LEFT JOIN location
        ON event.eventLocationId = location.locationId
        WHERE ((user.userId = $currUserId AND event.eventPrivacy = 2 AND rso_members.userId = $currUserId AND user.univId = event.eventUnivId
        OR 
        event.eventPrivacy = 1 AND user.univId = event.eventUnivId)
        AND
        (eventName LIKE '%$search%' OR eventCategory LIKE '%$search%' OR eventDescription LIKE '%$search%'))
        UNION 
        SELECT DISTINCT event.eventId, event.eventName, event.eventCategory, event.eventDescription, event.eventDate, event.eventTime, event.eventLocationId, event.eventRsoId, event.eventContactPhone, event.eventContactEmail, location.locationAddress
        FROM event
        LEFT JOIN location
        ON event.eventLocationId = location.locationId
        WHERE
        event.eventPrivacy = 0
        AND
        (eventName LIKE '%$search%' OR eventCategory LIKE '%$search%' OR eventDescription LIKE '%$search%')
        ";
        $result = mysqli_query($db, $sql);
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
                // FETCH: individual event
                $event_id = $event_info['eventId'];
                $event_name= $event_info['eventName'];
                $event_category = $event_info['eventCategory'];
                $event_description = $event_info['eventDescription'];
                $event_date = $event_info['eventDate'];
                $event_time = $event_info['eventTime'];
                $event_location = $event_info['locationAddress'];
                $event_phone = $event_info['eventContactPhone'];
                $event_email = $event_info['eventContactEmail'];

                // TABLE: fill the table with events, click sends user to an event page
                $display_block .= "
                <tr>
                <td><a href=\"event_page.php?eventId=$event_id\">
                <strong>$event_name</strong></a><br>
                <td><strong>$event_category</strong></a><br>
                <td><strong>$event_description</strong></a><br>
                <td><strong>$event_date</strong></a><br>
                <td><strong>$event_time</strong></a><br>
                <td><strong>$event_location</strong></a><br>
                <td><strong>$event_phone</strong></a><br>
                <td><strong>$event_email</strong></a><br>
                </tr>";         
            }

            // TABLE: end
            $display_block.= "</table>";
        } else {
            $display_block = "<p><em>No events to display.</em><p>";
        }
    }
?>


<html>
    <head>
        <title> University Events </title>
    </head>
    <body>
        <h1> Events </h1>
        <?php print $display_block; ?>
    </body>
</html>

<?php
    require_once 'includes/footer.php';
?>
