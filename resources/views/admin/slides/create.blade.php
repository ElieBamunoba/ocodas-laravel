{{-- resources/views/admin/slides/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Slide') }}
        </h2>
    </x-slot>

    <form action="{{ route('admin.slides.store') }}" enctype="multipart/form-data" method="POST" class="space-y-6">
        @csrf
        @include('admin.slides.form')

    </form>
</x-app-layout>
