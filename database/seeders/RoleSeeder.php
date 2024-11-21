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
        //Rol de usuario Admin
        $roleAdmin = new Role();
        $roleAdmin->name = 'Admin';
        $roleAdmin->save();

        //Rol de usuario Gestor
        $roleGestor = new Role();
        $roleGestor->name = 'Gestor';
        $roleGestor->save();

        //Rol de usuario Visitante

        $roleVisitante = new Role();
        $roleVisitante->name = 'Visitante';
        $roleVisitante->save();




        
        
    }
}
