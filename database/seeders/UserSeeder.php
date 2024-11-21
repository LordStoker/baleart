<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //User Admin
        $adminUser = new User();
        $adminUser->name = 'Admin';
        $adminUser->lastName = 'Istrador';
        $adminUser->email = 'admin@admin.com';
        $adminUser->phone = '666666666';
        $adminUser->password = 'admin123';
        $adminUser->role_id = 1;
        $adminUser->save();

        //Users Gestores

        $jsonData = file_get_contents("C:\\temp\\baleart\\usuaris.json");
        $users = json_decode($jsonData, true);
        if ($jsonData === false || $users === null) {
            throw new \Exception("Error al leer o procesar el JSON.");
        }
        foreach ($users['usuaris']['usuari'] as $user) {
            $gestorUser = new User();
            $gestorUser->name = $user['nom'];
            $gestorUser->lastName = $user['llinatges'];
            $gestorUser->email = $user['email'];
            $gestorUser->phone = $user['telefon'];
            $gestorUser->password = $user['password'];
            $gestorUser->role_id = 2;
            $gestorUser->save();
        }
    }
}
