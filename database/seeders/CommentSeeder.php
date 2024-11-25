<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Space;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents("C:\\temp\\baleart\\comentaris.json");
        $comments = json_decode($jsonData, true);
        if ($jsonData === false || $comments === null) {
            throw new \Exception("Error al leer o procesar el JSON.");
        }
        foreach ($comments['comentaris']['comentari'] as $comentari) {
            $comment = new Comment();
            $comment->comment = $comentari['text'];
            $comment->score = $comentari['puntuacio'];
            $comment->status = ['n', 'y'][array_rand(['n', 'y'])];
            $comment->space_id = Space::where('regNumber', $comentari['espai'])->first()->id;
            $comment->user_id = User::where('email', $comentari['usuari'])->first()->id;
            $comment->save();
        }
    }
}
