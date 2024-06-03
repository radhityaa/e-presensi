<?php

namespace Database\Seeders;

use App\Models\SettingLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class SettingLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SettingLocation::create([
            'uuid' => Uuid::uuid4(),
            'location' => '-6.369065,107.399069',
            'radius' => 10,
        ]);
    }
}
