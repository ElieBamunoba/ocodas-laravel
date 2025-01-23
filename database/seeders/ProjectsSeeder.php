<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'image' => 'assets/img/portfolio/iseav1.png',
                'categories' => ['app'],
                'title' => 'ISEAV ARU',
                'link' => 'https://iseav-aru.org',
                'description' => 'Website'
            ],
            [
                'image' => 'assets/img/portfolio/camera.jpg',
                'categories' => ['web'],
                'title' => 'Installation des caméras de surveillance',
                'link' => '#',
                'description' => 'Clinique Karibuni, Super Marché Manager Business, Station-service'
            ],
            [
                'image' => 'assets/img/portfolio/gna1.png',
                'categories' => ['app'],
                'title' => 'Good News Africa Sarlu Construction',
                'link' => 'https://goodnewsafricardc.com/',
                'description' => 'Website'
            ],
            [
                'image' => 'assets/img/portfolio/conference.jpg',
                'categories' => ['card'],
                'title' => 'Formation sur la conception et déploiement du réseau local Edition 1',
                'link' => '#',
                'description' => 'Developpement'
            ],
            [
                'image' => 'assets/img/portfolio/network.jpg',
                'categories' => ['web'],
                'title' => 'Fourniture de la connexion internet',
                'link' => '#',
                'description' => 'Monusco Banrdb, ISTM Nyakunde, ...'
            ]
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}