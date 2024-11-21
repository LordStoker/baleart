<?php

namespace Database\Seeders;

use App\Models\Space;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Importaremos los espacios desde un json e instanciaremos un objeto con los astributos con cada key correspondiente e insertaremos cada uno
        $jsonData = file_get_contents("C:\\temp\\baleart\\espais.json");
        $spaces = json_decode($jsonData, true);
        if ($jsonData === false || $spaces === null) {
            throw new \Exception("Error al leer o procesar el JSON.");
        }
        foreach ($spaces['espais']['espai'] as $espai) {
            
            $tipusAccess = $espai['accessibilitat'];
            $tipusAccess = ($tipusAccess === "Sí") ? 'y' : (($tipusAccess === "No") ? 'n' : 'p');

            $space = new Space();
            $space->name = $espai['nom'];
            $space->regNumber = $espai['registre'];
            $space->observation_CA = $espai['descripcions/cat'];
            $space->observation_ES = $espai['descripcions/esp'];
            $space->observation_EN = $espai['descripcions/eng'];
            $space->email = $espai['email'];
            $space->phone = $espai['telefon'];
            $space->website = $espai['web'];
            $space->accesType = $tipusAccess;
            $space->totalScore = 0;
            $space->countScore = 0;

            // TO DO: USAR EL ID DE LA DIREECCIÓN PARA INSTANCIARLA y TERMINAR DE ASIGNAR VALORES A LOS ESPACIOS PARA QUE NO DÉ FALLO
            //AL SER FK. INSTANCIARÉ LAS ADDRESSES EN EL MISMO RECORRIDO DEL JSON DE ESPACIOS 

            $space->address_id = $espai['adreca'];
            $space->space_type_id = $espai['tipus'];
            $space->user_id = $espai['gestor'];


            $space->modality_id = $espai['modalitat'];
            $space->save();
        }
    }
}
