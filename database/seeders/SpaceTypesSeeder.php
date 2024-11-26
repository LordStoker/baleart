<?php

namespace Database\Seeders;

use App\Models\Space;
use App\Models\SpaceType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpaceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents("C:\\temp\\baleart\\tipus.json");
        $spaceTypes = json_decode($jsonData, true);
        if ($jsonData === false || $spaceTypes === null) {
            throw new \Exception("Error al leer o procesar el JSON.");
        }
        foreach ($spaceTypes['tipusespais']['tipus'] as $spaceTipus) {
            SpaceType::Create([
                'name' => $spaceTipus['cat'],
                'description_CA' => $spaceTipus['cat'],
                'description_ES' => $spaceTipus['esp'],
                'description_EN' => $spaceTipus['eng']
            ]);
        }
    }
}
