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
            'nik' => '1234567890',
            'phone' => '0895347113987',
            'email' => 'admin@gmail.com',
            'status' => 1,
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole($roleAdmin);

        $staff = User::create([
            'name' => 'Staff',
            'nik' => '1234567891',
            'phone' => '0895347113987',
            'email' => 'staff@gmail.com',
            'status' => 1,
            'password' => bcrypt('password'),
        ]);
        $staff->assignRole($roleStaff);

        $guru = User::create([
            'name' => 'Guru',
            'nik' => '1234567892',
            'phone' => '0895347113987',
            'email' => 'guru@gmail.com',
            'status' => 1,
            'password' => bcrypt('password'),
        ]);
        $guru->assignRole($roleGuru);

        $walikelas = User::create([
            'name' => 'Walikelas',
            'nik' => '1234567893',
            'phone' => '0895347113987',
            'email' => 'walikelas@gmail.com',
            'status' => 1,
            'password' => bcrypt('password'),
        ]);
        $walikelas->assignRole($roleWalikelas);
    }
}
