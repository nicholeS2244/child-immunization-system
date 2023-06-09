<?php

function vaccineDate($minage,$dob)
{
    $date_array = [];

    // Min Age -
    $min_age = "";
    $years = $months = $weeks = $days = 0;
    $ignore = true;
    $total_time = $minage;

    $years = $total_time / 365;
    $years = floor($years);
    $months = ($total_time % 365) / 30;
    $months = floor($months);
    $days = ($total_time % 365) % 30;

    if ($years > 0) {
        if ($months > 0) {
            $min_age = $years * 12 + $months . " months ";
        } else {
            $min_age = $years . " years ";
        }
        $ignore = false;
    }
    if ($months > 0 && $ignore) {
        if ($days > 7 && $days < 30) {
            $min_age = $months * 30 + $days;
            $weeks = $min_age / 7;
            $min_age = $weeks . " weeks ";
            $ignore = false;
        } elseif ($days < 30) {
            $min_age = $min_age . $months . " months ";
        }
    }
    if ($days > 0 && $ignore) {
        $min_age = $min_age . $days . " days";
    }

    // Vaccine Due Date -
    $vaccinedate = new DateTime($dob);
    $vaccinedate->add(new DateInterval('P' . $minage . 'D'));

    $date_array[0] = $min_age;
    $date_array[1] = $vaccinedate->format('Y-m-d');

    return $date_array;
}

?>
