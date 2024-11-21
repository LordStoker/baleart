<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Zone;
use App\Models\Modality;
use App\Models\Municipality;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ZoneSeeder;
use Database\Seeders\IslandSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\ModalitySeeder;
use Database\Seeders\MunicipalitySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(IslandSeeder::class);
        $this->call(ZoneSeeder::class);
        $this->call(MunicipalitySeeder::class);
        $this->call(ModalitySeeder::class);
        $this->call(ServiceSeeder::class);

    }
}
