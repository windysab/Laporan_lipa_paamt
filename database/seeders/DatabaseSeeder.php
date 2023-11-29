<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Khs;
use App\Models\AbsensiMatkul;
use Database\Seeders\KhsSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\SubjectSeeder;
use Database\Seeders\ScheduleSeeder;
use Database\Seeders\AbsensiMatkulSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            SubjectSeeder::class,
            ScheduleSeeder::class,
            KhsSeeder::class,
            AbsensiMatkulSeeder::class,
        ]);
    }
}
