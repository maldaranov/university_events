<?php
    require_once 'includes/header.php';
?>

<div>
    <h1> Create University Profile </h1>

    <form action="includes/create_university_profile-inc.php" method="post">
            <!-- university name input -->
            <label class="required" for="uName"> University Name </label>
            <input id="uName" type="text" required size=30 name="univName" placeholder="University Name">

            <!-- university location input -->
            <label class="required" for="uLocation"> Location </label>
            <input id="uLocation" type="text" name="univLocation" placeholder="location">   

            <!-- university description input -->
            <label for="uDescription"> Description: </label>
            <textarea id="uDescription" name="univDescription" rows=10 cols=27 maxlength=500 placeholder="maximum length is 500 characters"></textarea>

            <!-- number of students input -->
            <label class="required" for="uNumStudents"> Number of Students </label>
            <input id="uNumStudents" type="number" name="univNumStudents" placeholder="123">

            <!-- university tag input -->
            <label class="required" for="uTag"> Tag </label>
            <input id="uTag" type="text" name="univTag" placeholder="@something.edu"> 

            <!-- university picture input -->
            <label class="required" for="uPicture"> Picture </label>
            <textarea id="uPicture" name="univPicture" rows=5 cols=27 maxlength=500 placeholder="url"></textarea>
            <p><button type="submit" name="submit">CREATE</button></p>
    </form>
</div>
