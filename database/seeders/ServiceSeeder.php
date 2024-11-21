<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents("C:\\temp\\baleart\\serveis.json");
        $services = json_decode($jsonData, true);
        if ($jsonData === false || $services === null) {
            throw new \Exception("Error al leer o procesar el JSON.");
        }
        foreach ($services['serveis']['servei'] as $servei) {
            $service = new Service();
            $service->name = $servei['cat'];
            $service->description_CA = $servei['cat'];
            $service->description_ES = $servei['esp'];
            $service->description_EN = $servei['eng'];
            $service->save();
        }

    }
}
