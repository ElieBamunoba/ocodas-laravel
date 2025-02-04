<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProjectsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $projects = [

            [
                "image" => "images/portfolio/01.jpg",
                "categories" => ["Painting", "Plumbing"],
                "title" => "Plumbing, New York",
                "link" => "portfolio-style-1.html"
            ],
            [
                "image" => "images/portfolio/02.jpg",
                "categories" => ["Tiles repair, Austin"],
                "title" => "Home Maintenance",
                "link" => "portfolio-style-2.html"
            ],
            [
                "image" => "images/portfolio/03.jpg",
                "categories" => ["Flooring", "Plumbing"],
                "title" => "Floor Flooring, Bunnell",
                "link" => "portfolio-style-3.html"
            ],
            [
                "image" => "images/portfolio/04.jpg",
                "categories" => ["Flooring", "Home Maintenance"],
                "title" => "Drywall Insulation, Captown",
                "link" => "portfolio-style-1.html"
            ],
            [
                "image" => "images/portfolio/05.jpg",
                "categories" => ["Electrical", "Painting"],
                "title" => "Electrical wiring, San Jose",
                "link" => "portfolio-style-2.html"
            ],
            [
                "image" => "images/portfolio/06.jpg",
                "categories" => ["Electrical", "Home Maintenance"],
                "title" => "Fireplace cleaning, Portland",
                "link" => "portfolio-style-3.html"
            ],
            [
                "image" => "images/portfolio/07.jpg",
                "categories" => ["Electrical", "Roofing"],
                "title" => "Roofing, Berlin",
                "link" => "portfolio-style-3.html"
            ],
            [
                "image" => "images/portfolio/08.jpg",
                "categories" => ["Heating", "Plumbing"],
                "title" => "Heating system tune-up, Manham",
                "link" => "portfolio-style-3.html"
            ],
            [
                "image" => "images/portfolio/09.jpg",
                "categories" => ["Heating", "Roofing"],
                "title" => "Sealing driveways, New York",
                "link" => "portfolio-style-3.html"
            ],
            [
                "image" => "images/portfolio/01.jpg",
                "categories" => ["Painting", "Plumbing"],
                "title" => "Plumbing, New York",
                "link" => "portfolio-style-1.html"
            ],
            [
                "image" => "images/portfolio/05.jpg",
                "categories" => ["Electrical", "Painting"],
                "title" => "Electrical wiring, San Jose",
                "link" => "portfolio-style-2.html"
            ],
            [
                "image" => "images/portfolio/01.jpg",
                "categories" => ["Painting", "Plumbing"],
                "title" => "Plumbing, New York",
                "link" => "portfolio-style-1.html"
            ],
            [
                "image" => "images/portfolio/03.jpg",
                "categories" => ["Flooring", "Plumbing"],
                "title" => "Floor Flooring, Bunnell",
                "link" => "portfolio-style-3.html"
            ],
            [
                "image" => "images/portfolio/08.jpg",
                "categories" => ["Heating", "Plumbing"],
                "title" => "Heating system tune-up, Manham",
                "link" => "portfolio-style-3.html"
            ],
            [
                "image" => "images/portfolio/02.jpg",
                "categories" => ["Tiles repair, Austin"],
                "title" => "Home Maintenance",
                "link" => "portfolio-style-2.html"
            ],
            [
                "image" => "images/portfolio/04.jpg",
                "categories" => ["Flooring", "Home Maintenance"],
                "title" => "Drywall Insulation, Captown",
                "link" => "portfolio-style-1.html"
            ],
            [
                "image" => "images/portfolio/06.jpg",
                "categories" => ["Electrical", "Home Maintenance"],
                "title" => "Fireplace cleaning, Portland",
                "link" => "portfolio-style-3.html"
            ],
            [
                "image" => "images/portfolio/03.jpg",
                "categories" => ["Flooring", "Plumbing"],
                "title" => "Floor Flooring, Bunnell",
                "link" => "portfolio-style-3.html"
            ],
            [
                "image" => "images/portfolio/04.jpg",
                "categories" => ["Flooring", "Home Maintenance"],
                "title" => "Drywall Insulation, Captown",
                "link" => "portfolio-style-1.html"
            ],
            [
                "image" => "images/portfolio/05.jpg",
                "categories" => ["Electrical", "Painting"],
                "title" => "Electrical wiring, San Jose",
                "link" => "portfolio-style-2.html"
            ],
            [
                "image" => "images/portfolio/06.jpg",
                "categories" => ["Electrical", "Home Maintenance"],
                "title" => "Fireplace cleaning, Portland",
                "link" => "portfolio-style-3.html"
            ],
            [
                "image" => "images/portfolio/07.jpg",
                "categories" => ["Electrical", "Roofing"],
                "title" => "Roofing, Berlin",
                "link" => "portfolio-style-3.html"
            ],
            [
                "image" => "images/portfolio/08.jpg",
                "categories" => ["Heating", "Plumbing"],
                "title" => "Heating system tune-up, Manham",
                "link" => "portfolio-style-3.html"
            ],
            [
                "image" => "images/portfolio/09.jpg",
                "categories" => ["Heating", "Roofing"],
                "title" => "Sealing driveways, New York",
                "link" => "portfolio-style-3.html"
            ]
        ];

        foreach ($projects as $project) {
            $project['description'] = $faker->paragraph();
            $project['additional_images'] = [];
            Project::create($project);
        }
    }
}
