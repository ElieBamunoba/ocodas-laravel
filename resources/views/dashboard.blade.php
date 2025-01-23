{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @php
        $dashboardItems = [
            [
                'title' => 'Projects',
                'count' => \App\Models\Project::count(),
                'route' => route('admin.projects.index'),
            ],
            [
                'title' => 'Slides',
                'count' => \App\Models\Slide::count(),
                'route' => route('admin.slides.index'),
            ],
            [
                'title' => 'Users',
                'count' => \App\Models\User::count(),
                'route' => route('admin.users.index'),
            ]
        ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ($dashboardItems as $item)
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-gray-900 dark:text-gray-100">
                    <span class="flex justify-between">
                        <h3 class="text-lg font-semibold mb-2">{{ $item['title'] }}</h3>
                        {{-- visit page --}}
                        <a href="{{ $item['route'] }}"
                            class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600">View
                            <span class="text-xl">></span>
                        </a>
                    </span>
                    <p class="text-3xl font-bold">{{ $item['count'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
