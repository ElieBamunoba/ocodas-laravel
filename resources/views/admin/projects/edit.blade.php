{{-- resources/views/admin/projects/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <form action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" method="POST"
        class="space-y-6">
        @csrf
        @method('PUT')
        @include('admin.projects.form')

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Update Project
            </button>
        </div>
    </form>
</x-app-layout>
