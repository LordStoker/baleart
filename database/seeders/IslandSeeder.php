<?php

namespace Database\Seeders;

use App\Models\Island;
use GuzzleHttp\Promise\Is;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IslandSeeder extends Seeder
{/**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Mallorca
        Island::create([
            'name' => 'Mallorca'
        ]);

        //Menorca
        Island::create([
            'name' => 'Menorca'
        ]);

        //Ibiza
        Island::create([
            'name' => 'Eivissa'
        ]);

        //Formentera
        Island::create([
            'name' => 'Formentera'
        ]);

        //Cabrera
        Island::create([
            'name' => 'Cabrera'
        ]);

    }
}
