<?php

function setComments($db)
{
    if (isset($_POST['commentSubmit'])) 
    {
        require 'server.php'; // grab the database
        
        $comment_eventId = $_POST['comment_eventId'];
        $comment_userId = $_POST['comment_userId'];
        $comment_userName = $_POST['comment_userName'];
        $comment_msg = $_POST['comment_msg'];
        $comment_datetime = $_POST['comment_datetime'];
    
        $sql = "INSERT INTO event_comment (comment_eventId, comment_userId, comment_userName, comment_msg, comment_datetime) 
                VALUES ('$comment_eventId', '$comment_userId', '$comment_userName', '$comment_msg', '$comment_datetime')";
        
        $result = $db->query($sql);
    }
}

?>