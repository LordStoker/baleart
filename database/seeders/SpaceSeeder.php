<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Zone;
use App\Models\Space;
use App\Models\Address;
use App\Models\SpaceType;
use App\Models\Municipality;
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
        foreach ($spaces as $espai) {
            
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
            $space->accessType = $tipusAccess;
            $space->totalScore = 0;
            $space->countScore = 0;

            //Instanciación de Address
            //--------------------------------

            $address = new Address();
            $address->name = $espai['adreca'];

            //Obtención de ID de las FK Zone y Municipality para Address
            $addressMunicipalityName = $espai['municipi'];
            $addressMunicipality = Municipality::where('name', $addressMunicipalityName)->first();
            if ($addressMunicipality) {
                $address->municipality_id = $addressMunicipality->id; 
            } else {
                throw new \Exception("Municipio no encontrado: " . $addressMunicipalityName);
            }

            $addressZoneName = $espai['zona'];
            $addressZone = Zone::where('name', $addressZoneName)->first();
            if ($addressZone) {
                $address->zone_id = $addressZone->id; 
            } else {
                throw new \Exception("Zona no encontrada: " . $addressZoneName);
            }
            $address->save();
            //--------------------------------

            
            //Continuación de Space
            $space->address_id = $address->id;
            $spaceTypeName = $espai['tipus'];
            $spaceType = SpaceType::where('name', $spaceTypeName)->first();
            if ($spaceType) {
                $space->space_type_id = $spaceType->id; 
            } else {
                throw new \Exception("Tipo de espacio no encontrado: " . $spaceTypeName);
            }
            $spaceGestorEmail = $espai['gestor'];
            $spaceGestor = User::where('email', $spaceGestorEmail)->first();
            if ($spaceGestor) {
                $space->user_id = $spaceGestor->id; 
            } else {
                $space->user_id = 1;
            }
            $space->save();
        }
    }
}
