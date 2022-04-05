<?php
    require_once 'includes/header.php';
?>

<div>
    <h1> Create Event </h1>

    <form action="includes/create_event-inc.php" method="post">
            <!-- event name input -->
            <label class="required" for="eName"> Title </label>
            <input id="eName" type="text" required size=30 name="eventName" placeholder="Title">

            <!-- event category input -->
            <label class="required" for="eCategory"> Category </label>
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
            <label class="required" for="eDate"> Date </label>
            <input id="eDate" type="date" name="eventDate" placeholder="date">

            <!-- event time slot input -->
            <label class="required" for="eTime"> Time slot </label>
            <select id="eTime" name="eventTime">
                <option value=""> Choose a time slot </option>
                <option value="6"> 6:00 a.m - 7:00 a.m </option>
                <option value="7"> 7:00 a.m - 8:00 a.m </option>
                <option value="8"> 8:00 a.m - 9:00 a.m </option>
                <option value="9"> 9:00 a.m - 10:00 a.m  </option>
                <option value="10"> 10:00 a.m - 11:00 a.m </option>
                <option value="11"> 11:00 a.m - 12:00 p.m </option>
                <option value="12"> 12:00 p.m - 1:00 p.m </option>
                <option value="13"> 1:00 p.m- 2:00 p.m </option>
                <option value="14"> 2:00 p.m  - 3:00 p.m </option>
                <option value="15"> 3:00 p.m - 4:00 p.m </option>
                <option value="16"> 4:00 p.m- 5:00 p.m </option>
                <option value="17"> 5:00 p.m - 6:00 p.m </option>
                <option value="18"> 6:00 p.m - 7:00 p.m </option>
                <option value="19"> 7:00 p.m - 8:00 p.m </option>
                <option value="20"> 9:00 p.m - 10:00 p.m </option>
                <option value="21"> 10:00 p.m - 11:00 p.m </option>
            </select>

            <!-- event contact phone input -->
            <label class="required" for="ePhone"> Contact Phone </label>
            <input id="ePhone" type="tel" name="eventPhone" placeholder="Phone Number">

            <!-- event email input -->
            <label class="required" for="eEmail"> Contact Email </label>
            <input id="eEmail" type="email" name="eventEmail" placeholder="Email">

            <!-- event privacy input -->
            <label class="required" for="ePrivacy"> Privacy </label>
            <select id="ePrivacy" name="eventPrivacy">
                <option value="0"> Public </option>
                <option value="1"> Private </option>
                <option value="2"> RSO </option>
            </select>   
            
            <!-- event rso id input -->
            <label for="eRsoId"> (if RSO privacy chosen) </label>
            <input id="eRsoId" type="text" name="eventRsoId" placeholder="RSO Name">            

            <!-- event location input-->
            <label class="required" for="eLocation"> Location </label>
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
