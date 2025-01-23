{{-- resources/views/admin/slides/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Slide') }}
        </h2>
    </x-slot>

    <form action="{{ route('admin.slides.update', $slide) }}" enctype="multipart/form-data" method="POST"
        class="space-y-6">
        @csrf
        @method('PUT')
        @include('admin.slides.form')
    </form>
</x-app-layout>
