<?php

namespace App\Helpers;

use App\Models\AbsenceTime;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class MyHelper
{
    public static function getRoles()
    {
        return Role::all();
    }

    public static function getAbsenceTime(string $type, $formatted = false)
    {
        $absenceTime = AbsenceTime::first();

        if ($formatted) {
            return Carbon::createFromFormat('H:i:s', $absenceTime->time_in)->format('H:i');
        }

        return $type === 'in' ? $absenceTime->time_in : $absenceTime->time_out;
    }
}
