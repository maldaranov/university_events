<?php
    require_once 'includes/header.php';
?>

<?php

    // Profiles List
    $currUserId = $_SESSION['user_id'];
    $query ="SELECT * FROM university";
    $result = mysqli_query($db, $query);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        // TABLE: column names
        $display_block = "
        <table cellpadding=3 cellspacing=5 border=0>
        <th>University Name</th>
        <th>Location</th>
        </tr>";

        while($univ_info = mysqli_fetch_array($result)) {
            // FETCH: individual university
            $university_id = $univ_info['univId'];
            $univ_name= $univ_info['univName'];
            $univ_location= $univ_info['univLocation'];

            // TABLE: fill the table with universities, click sends user to a university page
            $display_block .= "
            <tr>
            <td><a href=\"university_page.php?univId=$university_id\">
            <strong>$univ_name</strong></a><br>
            <td><strong>$univ_location</strong></a><br>
            </tr>";         
        }

        // TABLE: end
        $display_block.= "</table>";
    } else {
        $display_block = "<p><em>No universities to display.</em><p>";
    }

?>

<html>
    <head>
        <title> University Profiles </title>
    </head>
    <body>
        <h1> University Profiles </h1>
        <?php print $display_block; ?>
    </body>
</html>

<?php
    require_once 'includes/footer.php';
?>

