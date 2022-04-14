<?php
    require_once 'includes/header.php';
    include 'includes/event_page-inc.php';
?>

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style_comment.css">

<!-- Comment text box -->
<?php
    $comment_msg = $_POST['comment_msg'];

echo "<form action='".editComments($db)."' method='post'>
    <input type='hidden' name='commentId' value='".$_POST['commentId']."'>
    <input type='hidden' name='comment_eventId' value='".$_POST['comment_eventId']."'>
    <input type='hidden' name='comment_userName' value='".$_SESSION['user_username']."'>
    <input type='hidden' name='comment_datetime' value='".date('Y-m-d H:i:s')."'>
    <textarea name='comment_msg' rows='8' cols='100'>".$comment_msg."</textarea>
    <p align=center><button type='submit' name='editComment'>Edit</button></p>
</form>";
?>