<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Seeder;

class SlidesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            [
                'title' => 'Infrastructures',
                'description' => 'Nous développons des infrastructures fiables et modernes pour répondre aux besoins technologiques des entreprises et des communautés.',
                'img' => 'https://images.pexels.com/photos/33153/raisting-sattelit-reception-signal.jpg?auto=compress&cs=tinysrgb&w=600',
            ],
            [
                'title' => 'Réseautique',
                'description' => 'Des solutions de réseau sécurisées et performantes pour connecter les organisations et soutenir leur croissance.',
                'img' => 'https://images.pexels.com/photos/1054397/pexels-photo-1054397.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
            ],
            [
                'title' => 'Développement Logiciel',
                'description' => 'Des solutions numériques innovantes pour répondre aux besoins des entreprises, en optimisant les processus et en améliorant l\'efficacité.',
                'img' => 'https://images.pexels.com/photos/2582937/pexels-photo-2582937.jpeg?auto=compress&cs=tinysrgb&w=600',
            ],
            [
                'title' => 'Formations',
                'description' => 'Des programmes éducatifs pour renforcer les compétences et préparer les talents de demain.',
                'img' => 'assets/img/portfolio/conference.jpg',
            ],
        ];

        foreach ($slides as $slide) {
            Slide::create($slide);
        }
    }
}