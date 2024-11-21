<?php

namespace Database\Seeders;

use App\Models\Island;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IslandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Mallorca
        $islandMallorca = new Island();
        $islandMallorca->name = 'Mallorca';
        $islandMallorca->save();

        //Menorca
        $islandMenorca = new Island();
        $islandMenorca->name = 'Menorca';
        $islandMenorca->save();

        //Ibiza
        $islandIbiza = new Island();
        $islandIbiza->name = 'Eivissa';
        $islandIbiza->save();

        //Formentera
        $islandFormentera = new Island();
        $islandFormentera->name = 'Formentera';
        $islandFormentera->save();

        //Cabrera
        $islandCabrera = new Island();
        $islandCabrera->name = 'Cabrera';
        $islandCabrera->save();
        
        
    }
}
