<?php
    require_once 'includes/header.php';
?>

<div>
    <h1> Create Event </h1>

    <form action="includes/create_event-inc.php" method="post">
            <!-- event name input -->
            <label for="eName"> Title: </label>
            <input id="eName" type="text" required size=30 name="eventName" placeholder="Title">

            <!-- event category input -->
            <label for="eCategory"> Category: </label>
            <select id="eCategory" name="eventCategory">
                <option value=""> Choose a category </option>
                <option value="Academic ">  Academic </option>
                <option value="Arts Exhibit">  Arts Exhibit </option>
                <option value="Career/Jobs">  Career/Jobs </option>
                <option value="Concert/Performance">  Concert/Performance </option>
                <option value="Entertainment">  Entertainment </option>
                <option value="Health">  Health </option>
                <option value="Holiday">  Holiday </option>
                <option value="Meeting">  Meeting </option>
                <option value="Open Forum">  Open Forum </option>
                <option value="Recreation & Exercise ">  Recreation & Exercise </option>
                <option value="Service/Volunteer">  Service/Volunteer </option>
                <option value="Social Event">  Social Event </option>
                <option value="Speaker/Lecture/Seminar">  Speaker/Lecture/Seminar </option>
                <option value="Sports ">  Sports </option>
                <option value="Tour/Open House/Information Session"> Tour/Open House/Information Session </option>
                <option value="Uncategorized/Other">  Uncategorized/Other </option>
                <option value="Workshop/Conference">  Workshop/Conference </option>
            </select>        

            <!-- event date input -->
            <label for="eDate"> Date: </label>
            <input id="eDate" type="date" name="eventDate" placeholder="date">

            <!-- event time slot input -->
            <label for="eTime"> Time slot: </label>
            <select id="eTime" name="eventTime">
                <option value=""> Choose a time slot </option>
                <option value="1"> 6:00 a.m - 7:00 a.m </option>
                <option value="2"> 7:00 a.m - 8:00 a.m </option>
                <option value="3"> 8:00 a.m - 9:00 a.m </option>
                <option value="4"> 9:00 a.m - 10:00 a.m  </option>
                <option value="5"> 10:00 a.m - 11:00 a.m </option>
                <option value="6"> 11:00 a.m - 12:00 p.m </option>
                <option value="7"> 12:00 p.m - 1:00 p.m </option>
                <option value="8"> 1:00 p.m- 2:00 p.m </option>
                <option value="9"> 2:00 p.m  - 3:00 p.m </option>
                <option value="10"> 3:00 p.m - 4:00 p.m </option>
                <option value="11"> 4:00 p.m- 5:00 p.m </option>
                <option value="12"> 5:00 p.m - 6:00 p.m </option>
                <option value="12"> 6:00 p.m - 7:00 p.m </option>
                <option value="12"> 7:00 p.m - 8:00 p.m </option>
                <option value="12"> 9:00 p.m - 10:00 p.m </option>
                <option value="12"> 10:00 p.m - 11:00 p.m </option>
            </select>

            <!-- event privacy input -->
            <label for="ePrivacy"> Privacy:
            <select id="ePrivacy" name="eventPrivacy">
                <option value="0"> Public </option>
                <option value="1"> Private </option>
                <option value="2"> RSO </option>
            </select>

            <!-- event location input-->
            <label for="eLocation"> Location: </label>
            <textarea id="eLocation" name="eventLocation" rows=5 cols=27 maxlength=500 placeholder="1234 Street Name,&#10City, State, 12345"></textarea>

            






            <!-- event description input -->
            <label for="eDescription"> Description: </label>
            <textarea id="eDescription" name="eventDescription" rows=10 cols=27 maxlength=500 placeholder="maximum length is 500 characters"></textarea>
            <p><button type="submit" name="submit">HOST</button></p>
    </form>
</div>

<?php
    require_once 'includes/footer.php';
?>
