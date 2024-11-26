<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Zone;
use App\Models\Space;
use App\Models\Address;
use App\Models\Service;
use App\Models\Modality;
use App\Models\SpaceType;
use App\Models\Municipality;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Space_Address_PivotsSeeder extends Seeder
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
        foreach ($spaces as $espai) {

            //Instanciación de Address
            //--------------------------------

            $address = Address::create([
                'name' => $espai['adreca'],
                'municipality_id' => Municipality::where('name', $espai['municipi'])->first()->id,
                'zone_id' => Zone::where('name', $espai['zona'])->first()->id
            ]);
            //--------------------------------           
            
            //Instanciación de Space
            $tipusAccess = ($espai['accessibilitat'] === "Sí") ? 'y' : (($espai['accessibilitat'] === "No") ? 'n' : 'p');
            
            $spaceType = SpaceType::where('name', $espai['tipus'])->first();
            if (!$spaceType) {
                throw new \Exception("Tipo de espacio no encontrado: " . $espai['tipus']);
            }

            $spaceGestor = User::where('email', $espai['gestor'])->first();
            if (!$spaceGestor) {
                $spaceGestor = Role::where('name', 'Admin')->first();
                if (!$spaceGestor) {
                    throw new \Exception("Gestor no encontrado.");
                }
            }
            $space = Space::create([
                'name' => $espai['nom'],
                'regNumber' => $espai['registre'],
                'observation_CA' => $espai['descripcions/cat'],
                'observation_ES' => $espai['descripcions/esp'],
                'observation_EN' => $espai['descripcions/eng'],
                'email' => $espai['email'],
                'phone' => $espai['telefon'],
                'website' => $espai['web'],
                'accessType' => $tipusAccess,
                'totalScore' => 0,
                'countScore' => 0,
                'address_id' => $address->id,
                'space_type_id' => $spaceType->id,
                'user_id' => $spaceGestor->id
            ]);
            //--------------------------------

            // JSON TABLAS PIVOT
            $allModalities = (array_map('trim', explode(",", $espai['modalitats'])));
            $modalities = Modality::whereIn('name', $allModalities)->get();
            $space->modalities()->attach($modalities, ['created_at' => now(), 'updated_at' => now()]);
            
            $allServices = (array_map('trim', explode(",", $espai['serveis'])));
            $services = Service::whereIn('name', $allServices)->get();
            $space->services()->attach($services, ['created_at' => now(), 'updated_at' => now()]);

            
        }
    }
}
