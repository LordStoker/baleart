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
            $address = new Address();
            $address->name = $espai['adreca'];

            //Obtención de ID de las FK Zone y Municipality para Address
            $addressMunicipalityName = $espai['municipi'];
            $addressMunicipality = Municipality::where('name', $addressMunicipalityName)->first();
            $addressMunicipality ? $address->municipality_id = $addressMunicipality->id : throw new \Exception("Tipo de espacio no encontrado: " . $addressMunicipalityName);
            // if ($addressMunicipality) {
            //     $address->municipality_id = $addressMunicipality->id; 
            // } else {
            //     throw new \Exception("Municipio no encontrado: " . $addressMunicipalityName);
            // }

            $addressZoneName = $espai['zona'];
            $addressZone = Zone::where('name', $addressZoneName)->first();
            $addressZone ? $address->zone_id = $addressZone->id : throw new \Exception("Tipo de espacio no encontrado: " . $addressZoneName);
            // if ($addressZone) {
            //     $address->zone_id = $addressZone->id; 
            // } else {
            //     throw new \Exception("Zona no encontrada: " . $addressZoneName);
            // }
            $address->save();
            //--------------------------------
            
            
            $tipusAccess = ($espai['accessibilitat'] === "Sí") ? 'y' : (($espai['accessibilitat'] === "No") ? 'n' : 'p');

            $space = new Space();
            $space->name = $espai['nom'];
            $space->regNumber = $espai['registre'];
            $space->observation_CA = $espai['descripcions/cat'];
            $space->observation_ES = $espai['descripcions/esp'];
            $space->observation_EN = $espai['descripcions/eng'];
            $space->email = $espai['email'];
            $space->phone = $espai['telefon'];
            $space->website = $espai['web'];
            $space->accessType = $tipusAccess;
            $space->totalScore = 0;
            $space->countScore = 0;
            $space->address_id = $address->id;
            $spaceTypeName = $espai['tipus'];
            $spaceType = SpaceType::where('name', $spaceTypeName)->first();
            $spaceType ? $space->space_type_id = $spaceType->id : throw new \Exception("Tipo de espacio no encontrado: " . $spaceTypeName);
            $spaceGestorEmail = $espai['gestor'];
            $spaceGestor = User::where('email', $spaceGestorEmail)->first();
            $spaceGestor ? $space->user_id = $spaceGestor->id : $space->user_id = Role::where('name', 'Admin')->first()->id;
            $space->save();

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
