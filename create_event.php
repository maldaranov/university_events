<?php
    require_once 'includes/header.php';
?>

<div>
    <h1> Create Event </h1>

    <form action="includes/create_event-inc.php" method="post">
            <!-- event name input -->
            <label for="eName"> Event name: </label>
            <input id="eName" type="text" required size=30 name="eventName" placeholder="name">

            <!-- event category input -->
            <label for="eventCategory"> Category:
            <select id="eventCategory" name="eventCategory">
                <option value=""> Please choose a category </option>
                <option value="social"> social </option>
                <option value="fundraising"> fundraising </option>
                <option value="tech_talk"> tech talk </option>
                <option value="promotional"> promotional </option>
            </select>
            
            <!-- event date and time input -->
            <label for="eventDatetime"> Date and Time: </label>
            <input id="eventDatetime" type="datetime-local" name="eventDatetime" placeholder="date and time">

            <!-- event privacy -->
            <label for="eventPRivacy"> Type:
            <select id="eventPrivacy" name="eventPrivacy">
                <option value=""> Please choos a type </option>
                <option value="public"> public </option>
                <option value="private"> private </option>
                <option value="rso"> rso </option>
            </select>

            <!-- event description-->
            
            <label for="eventDescription"> Description: </label>
            <textarea id="eventDescription" name="eventDescription" rows=10 cols=50 maxlength=500 placeholder="maximum length is 500 characters"></textarea>
            <p><button type="submit" name="submit">HOST</button></p>
    </form>
</div>

<?php
    require_once 'includes/footer.php';
?>
