<?php

namespace Database\Seeders;

use App\Models\AbsenceTime;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AbsenceTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AbsenceTime::create([
            'slug' => Str::random(32),
            'time_in' => '07:00:00',
            'time_out' => '16:00:00',
        ]);
    }
}
