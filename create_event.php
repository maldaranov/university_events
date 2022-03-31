<?php
    require_once 'includes/header.php';
?>

<div>
    <h1> Create Event </h1>

    <form action="includes/create_event-inc.php" method="post">
            <!-- event name input -->
            <label for="eName"> Event name: </label>
            <input id="eName" type="text" required size=30 name="eventName" placeholder="name">

            <!-- event location input-->
            <label for="eLocation"> Location: </label>
            <textarea id="eLocation" name="eventLocation" rows=5 cols=27 maxlength=500 placeholder="address"></textarea>

            <!-- event category input -->
            <label for="eCategory"> Category:
            <select id="eCategory" name="eventCategory">
                <option value=""> Please choose a category </option>
                <option value="social"> social </option>
                <option value="fundraising"> fundraising </option>
                <option value="tech_talk"> tech talk </option>
                <option value="promotional"> promotional </option>
            </select>
            
            <!-- event date input -->
            <label for="eDate"> Date: </label>
            <input id="eDate" type="date" name="eventDate" placeholder="date">

            <!-- event time slot input -->
            <label for="eTime"> Time slot: </label>
            <select id="eTime" name="eventTime">
                <option value=""> Please choose a time slot </option>
                <option value="1"> 9:00 a.m - 10:00 a.m </option>
                <option value="2"> 10:00 a.m - 11:00 a.m </option>
                <option value="3"> 11:00 a.m - 12 p.m </option>
                <option value="4"> 12 p.m - 1:00 p.m </option>
                <option value="5"> 1:00 p.m - 2:00 p.m </option>
                <option value="6"> 2:00 p.m - 3:00 p.m </option>
                <option value="7"> 3:00 p.m - 4:00 p.m </option>
                <option value="8"> 4:00 p.m - 5:00 p.m </option>
                <option value="9"> 5:00 p.m - 6:00 p.m </option>
            </select>

            <!-- event privacy input -->
            <label for="ePrivacy"> Type:
            <select id="ePrivacy" name="eventPrivacy">
                <option value=""> Please choose a type </option>
                <option value="public"> public </option>
                <option value="rso"> private (RSO) </option>
            </select>

            <!-- event description input -->
            <label for="eDescription"> Description: </label>
            <textarea id="eDescription" name="eventDescription" rows=10 cols=27 maxlength=500 placeholder="maximum length is 500 characters"></textarea>
            <p><button type="submit" name="submit">HOST</button></p>
    </form>
</div>
