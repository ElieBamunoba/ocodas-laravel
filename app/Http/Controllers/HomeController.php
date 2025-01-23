<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct(Request $request)
    {
        // Set locale if provided in URL
        if ($request->route('locale')) {
            app()->setLocale($request->route('locale'));
        }

        app()->setLocale(Session::get('locale', 'en'));
    }
    public function index()
    {
        $projects = Project::all();

        $services = [
            [
                'icon' => 'bi bi-briefcase',
                'title' => 'Infrastructures réseaux',
                'description' => 'Nous sommes une équipe de techniciens professionnels et capables pour répondre aux besoins les plus importants des entreprises, des institutions publiques et privées, des Universités, des organisations non gouvernementales et locales.',
                'delay' => 100
            ],
            [
                'icon' => 'bi bi-card-checklist',
                'title' => 'Education & formation ICT',
                'description' => 'Elevez vos compétences et restez à la pointe de la technologie avec nos programmes de formation en Technologie de l\'Information et de la Communication.',
                'delay' => 200
            ],
            [
                'icon' => 'bi bi-bar-chart',
                'title' => 'Conception et mise en œuvre des solutions web',
                'description' => 'Boostez votre activité grâce à nos services de digitalisation, incluant la conception de solutions web innovantes et une sécurité informatique renforcée.',
                'delay' => 300
            ],
            [
                'icon' => 'bi bi-binoculars',
                'title' => 'Incubateur de Startups Innovantes',
                'description' => 'Donnez vie à vos idées avec notre incubateur de startups innovantes. Nous offrons un environnement propice au développement de projets entrepreneuriaux, en fournissant un soutien complet allant de l’idée initiale à la mise sur le marché.',
                'delay' => 400
            ],
            [
                'icon' => 'bi bi-brightness-high',
                'title' => 'Solutions TIC pour les Entreprises',
                'description' => 'Révolutionnez votre entreprise avec nos solutions TIC de pointe. Nous proposons une gamme complète de services pour vous aider à optimiser vos opérations, améliorer votre productivité et renforcer votre compétitivité.',
                'delay' => 500
            ],
            [
                'icon' => 'bi bi-calendar4-week',
                'title' => 'Accès Internet Haut Débit pour Tous',
                'description' => 'Profitez d\'une connexion Internet rapide et fiable avec notre service de fourniture d\'accès Internet. Que vous soyez un particulier ou une entreprise, nous vous offrons des solutions adaptées à vos besoins pour garantir une navigation fluide et sans interruption.',
                'delay' => 600
            ],
            [
                'icon' => 'bi bi-calendar4-week',
                'title' => 'Sous-Traitance Efficace et Fiable',
                'description' => 'Optimisez vos opérations avec nos services de sous-traitance fiables et efficaces. Nous vous aidons à externaliser certaines de vos activités pour vous permettre de vous concentrer sur votre cœur de métier.',
                'delay' => 600
            ],
            [
                'icon' => 'bi bi-calendar4-week',
                'title' => 'Gestion de Projets Professionnelle et Efficace',
                'description' => 'Confiez la gestion de vos projets à des experts pour garantir leur succès. Nous offrons des services de gestion de projets professionnels adaptés à vos besoins, depuis la planification initiale jusqu\'à la livraison finale.',
                'delay' => 600
            ]
        ];

        $slides = Slide::all();

        return view('home', compact('projects', 'services', 'slides'));
    }

}
