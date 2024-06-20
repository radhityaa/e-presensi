<?php

namespace App\Helpers;

use Spatie\Permission\Models\Role;

class MyHelper
{
    public static function getRoles()
    {
        return Role::all();
    }
}
