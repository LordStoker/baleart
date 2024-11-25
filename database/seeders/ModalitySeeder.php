<?php

namespace Database\Seeders;

use App\Models\Modality;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsdonData = file_get_contents("C:\\temp\\baleart\\modalitats.json");
        $modalities = json_decode($jsdonData, true);
        if ($jsdonData === false || $modalities === null) {
            throw new \Exception("Error al leer o procesar el JSON.");
        }
        foreach ($modalities['modalitats']['modalitat'] as $modalitat) {
            Modality::Create([
                'name' => $modalitat['cat'],
                'description_CA' => $modalitat['cat'],
                'description_ES' => $modalitat['esp'],
                'description_EN' => $modalitat['eng']
            ]);
        }
    }
}
