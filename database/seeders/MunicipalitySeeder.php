<?php

namespace Database\Seeders;

use App\Models\Island;
use App\Models\Municipality;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents("C:\\temp\\baleart\\municipis.json");
        $municipalities = json_decode($jsonData, true);
        if ($jsonData === false || $municipalities === null) {
            throw new \Exception("Error al leer o procesar el JSON.");
        }
        foreach ($municipalities['municipis']['municipi'] as $municipi) {
            Municipality::Create([
                'name' => $municipi['Nom'],
                'island_id' => Island::where('name', $municipi['Illa'])->first()->id
            ]);
        }
    }
}
