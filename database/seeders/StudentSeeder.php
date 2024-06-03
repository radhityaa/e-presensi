<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'name' => 'Rama Adhitya Setiadi',
            'nik' => 123456789,
            'classroom_id' => 1,
            'phone' => "0895347113987",
            'address' => 'Karawang',
            'password' => bcrypt('password')
        ]);
    }
}
