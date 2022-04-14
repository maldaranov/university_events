<?php
    function display_block_generate ($db, $query) {
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
                </tr>"; 

                while ($event_info = mysqli_fetch_assoc($result)) {
                    // FETCH: invdividual event
                    $event_id = $event_info['eventId'];
                    $event_name= $event_info['eventName'];
                    $event_category = $event_info['eventCategory'];
                    $event_description = $event_info['eventDescription'];
                    $event_date = $event_info['eventDate'];
                    $event_time = time_slot($event_info['eventTime']);
                    $event_locationId = fetch_location($db, $event_info['eventLocationId']);
                    // $event_phone = $event_info['eventContactPhone'];
                    // $event_email = $event_info['eventContactEmail'];
                    // $event_univId = $event_info['eventUnivId'];
                    // $event_privacy = $event_info['eventPrivacy'];
                    // $event_rosId = $event_info['eventRsoId'];

                    // TABLE: fill the table with events, click sends user to an event page
                    $display_block .= "
                    <tr>
                    <td><a href=\"event_page.php?eventId=$event_id\">
                    <strong>$event_name</strong></a><br>
                    <td><strong>$event_category</strong></a><br>
                    <td><strong>$event_description</strong></a><br>
                    <td><strong>$event_date</strong></a><br>
                    <td><strong>$event_time</strong></a><br>
                    <td><strong>$event_locationId</strong></a><br>
                    </tr>";
                }
                // TABLE: end
                $display_block.= "</table>";
            } else {
                $display_block = "<p><em>No events to display.</em><p>";
            }
            return $display_block;
        }
    ?>