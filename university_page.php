<?php
    require_once 'includes/header.php';
?>

<?php
    $uid = $_GET['univId'];
    $get_profile = "SELECT * FROM university WHERE univId = $uid";
    $result = mysqli_query($db, $get_profile);
    $university_info = mysqli_fetch_array($result);

    // FETCH individual university profile
    $univ_name= $university_info['univName'];
    $univ_location = $university_info['univLocation'];
    $univ_description = $university_info['univDescription'];
    $univ_num_students = $university_info['univNumStudents'];
    $univ_tag = $university_info['univTag'];
    $univ_picture = $university_info['univPicture'];
?>
    <html>
    <style>
    .center {
        align:center;
        text-align: center;
        display: block;
        margin: 30px auto;
        width: 300px;
        height: 300px;
    }
    </style>
    <img src="<?php echo $univ_picture; ?>" class="center"/>
    </html>

<?php
    $display_block = "
    <h1 style=text-align:center>$univ_name</h1>

    <p align=center> Location: $univ_location </p>
    <p align=center> Number of Students: $univ_num_students </p>
    <p align=center> Tag: $univ_tag </p>
    <p align=center> Description: $univ_description </p>
    ";
     print $display_block;
?>

<?php
    require_once 'includes/footer.php';
?>

