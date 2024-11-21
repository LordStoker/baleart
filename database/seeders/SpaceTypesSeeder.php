<?php

namespace Database\Seeders;

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
            $spaceType = new SpaceType();
            $spaceType->name = $spaceTipus['cat'];
            $spaceType->description_CA = $spaceTipus['cat'];
            $spaceType->description_ES = $spaceTipus['esp'];
            $spaceType->description_EN = $spaceTipus['eng'];
            $spaceType->save();
        }
    }
}
