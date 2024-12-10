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
        $islands = [
            'Mallorca',
            'Menorca',
            'Eivissa',
            'Formentera',
            'Cabrera'
        ];

        foreach ($islands as $island) {
            Island::create([
                'name' => $island
            ]);
            // $newIsland = new Island();
            // $newIsland->name = $island;
            // $newIsland->save();
        }

    }
}
