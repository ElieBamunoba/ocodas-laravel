{{-- resources/views/admin/slides/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Slides') }}
            </h2>
            <a href="{{ route('admin.slides.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Slide
            </a>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach ($slides as $slide)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <img src="{{ asset($slide->getMainImage()) }}" alt="{{ $slide->title }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $slide->caption1 }}</h3>
                    <p class="mt-1 text-gray-600 dark:text-gray-400">{{ $slide->caption2 }}</p>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-500">{{ $slide->caption3 }}</p>
                    <div class="mt-4 flex justify-end space-x-2">
                        <a href="{{ route('admin.slides.edit', $slide) }}"
                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">Edit</a>
                        <form action="{{ route('admin.slides.destroy', $slide) }}" method="POST" class="inline">
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
        {{ $slides->links() }}
    </div>
</x-app-layout>
