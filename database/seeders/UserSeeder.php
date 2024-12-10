<?php

namespace Database\Seeders;

use App\Models\Role;
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
        User::create([
            'name' => 'Admin',
            'last_name' => 'Istrador',
            'email' => 'admin@baleart.com',
            'phone' => '666666666',
            'password' => '12345678',
            'role_id' => Role::where('name', 'Admin')->first()->id
        ]);


        //Users Gestores

        $jsonData = file_get_contents("C:\\temp\\baleart\\usuaris.json");
        $users = json_decode($jsonData, true);
        if ($jsonData === false || $users === null) {
            throw new \Exception("Error al leer o procesar el JSON.");
        }
        foreach ($users['usuaris']['usuari'] as $user) {
            User::Create([
                'name' => $user['nom'],
                'last_name' => $user['llinatges'],
                'email' => $user['email'],
                'phone' => $user['telefon'],
                'password' => $user['password'],
                'role_id' => Role::where('name', 'Gestor')->first()->id
            ]);

        }
    }
}
