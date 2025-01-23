{{-- resources/views/admin/slides/form.blade.php --}}
@php
    use Illuminate\Support\Js;
    $errors = $errors ?? new \Illuminate\Support\MessageBag();
@endphp

<form method="POST" action="{{ isset($slide->id) ? route('admin.slides.update', $slide) : route('admin.slides.store') }}"
    enctype="multipart/form-data">
    @csrf
    @if (isset($slide->id))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 gap-6">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $slide->title ?? '') }}"
                placeholder="Slide"
                class="mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 {{ $errors->has('title') ? 'border-red-500' : 'border-gray-300' }}">
            @error('title')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-image-upload name="img" :value="$slide->img ?? null" label="Main Image" />
            @error('img')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
            <textarea name="description" id="description" rows="3"
                placeholder="Depuis notre création, nous nous engageons à offrir des systèmes énergétiques fiables et efficaces pour tous."
                class="mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }}">{{ old('description', $slide->description ?? '') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- submit --}}
        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Save
            </button>
        </div>
    </div>
</form>
