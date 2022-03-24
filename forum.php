<?php
    require_once 'includes/header.php';
?>

<title>Add an Event</title>
</head>
<h1>Add an Event</h1>
<form method=post action="addevent.php">
<p><strong>Name:</strong><br>
<input type="text" name="eventName" size=40 maxlength=150>
 <p><strong>Type:</strong><br>
 <input type="text" name="eventType" size=40 maxlength=150>
 <p><strong>Category:</strong><br>
<input type="text" name="eventCategory" size=40 maxlength=150>
 <p><strong>Description:</strong><br>
 <textarea name="eventDescription" rows=8 cols=40 wrap=virtual></textarea>
 <p><strong>Time/Date:</strong><br>
 <input type="text" name="eventTime" size=40 maxlength=150>
 <P><input type="submit" name="submit" value="Add Topic"></p>
 </form>