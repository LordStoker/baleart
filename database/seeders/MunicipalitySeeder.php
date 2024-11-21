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
        //Los municipis vendrán también cargado con un json

        $jsonData = file_get_contents("C:\\temp\\baleart\\municipis.json");
        $municipalities = json_decode($jsonData, true);
        if ($jsonData === false || $municipalities === null) {
            throw new \Exception("Error al leer o procesar el JSON.");
        }
        foreach ($municipalities['municipis']['municipi'] as $municipi) {
            $municipality = new Municipality();
            $municipality->name = $municipi['Nom'];
            $islandName = $municipi['Illa'];
            $island = Island::where('name', $islandName)->first(); //Buscamos la isla por nombre y lo guardamos, si existe le damos su ID a municipalities
            if ($island) {
                $municipality->island_id = $island->id; //Le asignamos el ID del nombre de la isla al id (FK) de municipios
            } else {
                throw new \Exception("Isla no encontrada: " . $islandName);
            }
            $municipality->save();
        }
    }
}
