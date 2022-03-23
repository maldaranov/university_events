<html>
<head>
<title>Add an Event</title>
</head>
<body>
<h1>Add an Event</h1>
<form method=post action="do_addtopic.php">
<p><strong>Name:</strong><br>
<input type="text" name="eventName" size=40 maxlength=150>
 <p><strong>Type:</strong><br>
 <input type="text" name="eventType" size=40 maxlength=150>
 <p><strong>Category:</strong><br>
<input type="text" name="eventCategory" size=40 maxlength=150>
 <p><strong>Description:</strong><br>
 <input type="text" name="eventDescription" size=40 maxlength=150>
 <p><strong>Time/Date:</strong><br>
 <input type="text" name="eventTime" size=40 maxlength=150>
 <P><strong>Post Text:</strong><br>
 <textarea name="post_text" rows=8 cols=40 wrap=virtual></textarea>
 <P><input type="submit" name="submit" value="Add Topic"></p>
 </form>
 </body>
 </html>