<?php

namespace App\Helpers;

class DateHelper
{
    public static function yearOptions($startYear)
    {
        $yearNow = date('Y');
        $options = '';

        for ($year = $startYear; $year <= $yearNow; $year++) {
            $selected = $year == $yearNow ? 'selected' : '';
            $options .= "<option value=\"{$year}\" {$selected}>{$year}</option>";
        }

        return $options;
    }
}
