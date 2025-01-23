{{-- resources/views/admin/projects/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Projects') }}
            </h2>
            <a href="{{ route('admin.projects.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Project
            </a>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($projects as $project)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <img src="{{ asset($project->getMainImage()) }}" alt="{{ $project->title }}"
                    class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $project->title }}</h3>
                    <div class="mt-2">
                        @foreach ($project->categories as $category)
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-1">
                                {{ $category }}
                            </span>
                        @endforeach
                    </div>
                    <div class="mt-4 flex justify-end space-x-2">
                        <a href="{{ route('admin.projects.edit', $project) }}"
                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">Edit</a>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $projects->links() }}
    </div>
</x-app-layout>
