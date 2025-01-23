{{-- resources/views/admin/users/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
        @csrf
        @include('admin.users.form')
        
    </form>
</x-app-layout>