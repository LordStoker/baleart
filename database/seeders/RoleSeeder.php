<?php

namespace Database\Seeders;

use App\Models\Role;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Admin',
            'Gestor',
            'Visitante'
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }
        // //Rol de usuario Admin
        // Role::create([
        //     'name' => 'Admin'
        // ]);

        // //Rol de usuario Gestor
        // Role::create([
        //     'name' => 'Gestor'
        // ]);

        // //Rol de usuario Visitante
        // Role::create([
        //     'name' => 'Visitante'
        // ]);

    }
}
