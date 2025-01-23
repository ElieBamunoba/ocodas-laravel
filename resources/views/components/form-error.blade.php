{{-- resources/views/components/form-error.blade.php --}}
@props(['for'])

@error($for)
    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
@enderror