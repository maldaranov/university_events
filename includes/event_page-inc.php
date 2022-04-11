<?php

function setComments($db)
{
    if (isset($_POST['commentSubmit'])) 
    {
        require 'server.php'; // grab the database
        
        $comment_eventId = $_POST['comment_eventId'];
        $comment_userName = $_POST['comment_userName'];
        $comment_msg = $_POST['comment_msg'];
        $comment_datetime = $_POST['comment_datetime'];
    
        $sql = "INSERT INTO event_comment (comment_eventId, comment_userName, comment_msg, comment_datetime) 
                VALUES ('$comment_eventId', '$comment_userName', '$comment_msg', '$comment_datetime')";
        
        $result = $db->query($sql);
    }
}

function getComments($db)
{
    require 'server.php'; // grab the database
    $eid = $_GET['eventId'];
    $get_comment = "SELECT * FROM event_comment WHERE comment_eventId = $eid";
    $sql = "SELECT * FROM event_comment WHERE comment_eventId = $eid";
    $result = mysqli_query($db, $get_comment);
    while ($row = mysqli_fetch_object($result))
    {
        echo "<div class='comment-box'><p>";
            echo $row->comment_userName."<br>";
            echo $row->comment_datetime."<br>";
            echo nl2br($row->comment_msg);
        echo "</p>
            <form class='edit-form' method='post' action='edit_comment.php'>
                <input type='hidden' name='commentId' value='".$row->commentId."'>
                <input type='hidden' name='comment_eventId' value='".$row->comment_eventId."'>
                <input type='hidden' name='comment_userName' value='".$row->comment_userName."'>
                <input type='hidden' name='comment_datetime' value='".$row->comment_datetime."'>
                <input type='hidden' name='comment_msg' value='".$row->comment_msg."'>
                <button>Edit</button>
            </form>
        </div>";
    }
}

function editComments($db)
{
    if (isset($_POST['editComment'])) 
    {
        require 'server.php'; // grab the database
        
        $commentId = $_POST['commentId'];
        $comment_eventId = $_POST['comment_eventId'];
        $comment_userName = $_POST['comment_userName'];
        $comment_datetime = $_POST['comment_datetime'];
        $comment_msg = $_POST['comment_msg'];
    
        $sql = "UPDATE event_comment SET comment_msg='$comment_msg' WHERE commentId='$commentId'";
        $result = $db->query($sql);
        header('location: event_page.php?eventId='.$comment_eventId);
    }
}

?>