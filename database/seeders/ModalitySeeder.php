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
            $modality = new Modality();
            $modality->name = $modalitat['cat'];
            $modality->description_CA = $modalitat['cat'];
            $modality->description_ES = $modalitat['esp'];
            $modality->description_EN = $modalitat['eng'];
            $modality->save();
        }
    }
}
