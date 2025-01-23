<?php
// app/View/Components/AdminNavigation.php
namespace App\View\Components;

use Illuminate\View\Component;

class AdminNavigation extends Component
{
    public function render()
    {
        $navigation = [
            [
                'name' => 'Dashboard',
                'route' => 'dashboard',
                'icon' => 'home',
            ],
            [
                'name' => 'Services',
                'route' => 'admin.services.index',
                'icon' => 'server',
            ],
            [
                'name' => 'Projects',
                'route' => 'admin.projects.index',
                'icon' => 'briefcase',
            ],
            [
                'name' => 'Slides',
                'route' => 'admin.slides.index',
                'icon' => 'image',
            ],
        ];

        return view('components.admin-navigation', [
            'navigation' => $navigation
        ]);
    }
}
