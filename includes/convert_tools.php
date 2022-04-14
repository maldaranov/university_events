<?php
    function fetch_location ($db, $locId) {
        $query = "SELECT locationAddress FROM location WHERE locationId = $locId";
        $result = mysqli_query($db, $query);
        if ($row= mysqli_fetch_assoc($result)) {
            return $row['locationAddress'];
        }
    }

    function privacy ($priv) {
        switch ($priv) {
            case 0:
                return "Public";
            case 1: 
                return "Private";
            case 2;
                return "RSO";
        }
    }

    function time_slot ($time_slot) {
        switch ($time_slot) {
            case 6:
                return "6:00 a.m - 7:00 a.m ";
            case 7:
                return "7:00 a.m - 8:00 a.m";
            case 8:
                return "8:00 a.m - 9:00 a.m";
            case 9:
                return "9:00 a.m - 10:00 a.m";
            case 10:
                return "10:00 a.m - 11:00 a.m";
            case 11:
                return "11:00 a.m - 12:00 p.m";
            case 12:
                return "12:00 p.m - 1:00 p.m ";
            case 13:  
                return "1:00 p.m- 2:00 p.m";
            case 14:
                return "2:00 p.m  - 3:00 p.m";
            case 15:
                return "3:00 p.m - 4:00 p.m ";
            case 16:
                return "4:00 p.m- 5:00 p.m";
            case 17:
                return "5:00 p.m - 6:00 p.m";
            case 18:
                return "6:00 p.m - 7:00 p.m";
            case 19:
                return "7:00 p.m - 8:00 p.m";
            case 20:
                return "9:00 p.m - 10:00 p.m";
            case 21:     
                return "10:00 p.m - 11:00 p.m";  
        }
    }
    ?>