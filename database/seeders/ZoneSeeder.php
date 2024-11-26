<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents("C:\\temp\\baleart\\zones.json");
        $zones = json_decode($jsonData, true);
        if ($jsonData === false || $zones === null) {
            throw new \Exception("Error al leer o procesar el JSON.");
        }

        foreach ($zones['zones']['zona'] as $zona) {
            Zone::create([
                'name' => $zona['Nom']
            ]);
        }
    }
}
