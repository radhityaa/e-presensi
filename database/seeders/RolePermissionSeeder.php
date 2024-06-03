<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleStaff = Role::create(['name' => 'staff']);
        $roleGuru = Role::create(['name' => 'guru']);
        $roleWalikelas = Role::create(['name' => 'walikelas']);

        $admin = User::create([
            'name' => 'Admininistrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole($roleAdmin);

        $staff = User::create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $staff->assignRole($roleStaff);

        $guru = User::create([
            'name' => 'Guru',
            'email' => 'guru@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $guru->assignRole($roleGuru);

        $walikelas = User::create([
            'name' => 'Walikelas',
            'email' => 'walikelas@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $walikelas->assignRole($roleWalikelas);
    }
}
