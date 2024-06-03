<?php

namespace App\Helpers;

class DifferenceTime
{
    public static function calculateTimeDifference($jam_in, $jam_out)
    {
        // Parse jam_in
        list($h_in, $m_in, $s_in) = explode(":", $jam_in);
        $dtEarly = mktime($h_in, $m_in, $s_in, 1, 1, 1);

        // Parse jam_out
        list($h_out, $m_out, $s_out) = explode(":", $jam_out);
        $dtLate = mktime($h_out, $m_out, $s_out, 1, 1, 1);

        // Calculate the difference
        $dtDifference = $dtLate - $dtEarly;

        // Calculate hours, minutes, and seconds
        $hours = floor($dtDifference / 3600);
        $minutes = floor(($dtDifference % 3600) / 60);
        $seconds = $dtDifference % 60;

        // Return the formatted time difference
        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }
}
