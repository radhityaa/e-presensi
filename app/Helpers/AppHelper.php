<?php

use App\Models\Schedule;
use Spatie\Permission\Models\Role;

if (!function_exists('getRoles')) {
    function getRoles()
    {
        return Role::get();
    }
}
