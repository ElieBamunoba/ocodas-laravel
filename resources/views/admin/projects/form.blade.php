{{-- resources/views/admin/projects/form.blade.php --}}
@php
    use Illuminate\Support\Js;
    $errors = $errors ?? new \Illuminate\Support\MessageBag();
@endphp



<div>
    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
    <input type="text" name="title" id="title" value="{{ old('title', $project->title ?? '') }}"
        class="mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 {{ $errors->has('title') ? 'border-red-500' : 'border-gray-300' }}">
    @error('title')
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>

<div>
    <x-image-upload name="image" :value="$project->image ?? null" label="Project Image" />
    @error('image')
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project
        Description</label>
    <textarea name="description" id="description" rows="3"
        class="mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }}">{{ old('description', $project->description ?? '') }}</textarea>
    @error('description')
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>

<div>
    <x-multiple-image-upload name="additional_images" :images="$project->getAdditionalImages() ?? []" label="Additional Images" :max-files="5"
        :max-file-size="2048" />
    @error('additional_images')
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
    @error('additional_images.*')
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Link</label>
    <input type="text" name="link" id="link" value="{{ old('link', $project->link ?? '') }}"
        class="mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 {{ $errors->has('link') ? 'border-red-500' : 'border-gray-300' }}">
    @error('link')
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>

<div x-data="{
    categories: {{ Js::from(old('categories', $project->categories ?? [])) }}
}">
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categories</label>
    <template x-for="(category, index) in categories" :key="index">
        <div class="flex mt-1">
            <input type="text" x-model="categories[index]" :name="'categories[]'"
                class="block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 border-gray-300">
            <button type="button" @click="categories.splice(index, 1)"
                class="ml-2 inline-flex items-center px-3 py-1 border border-red-600 rounded-md text-red-600 hover:bg-red-50 dark:hover:bg-red-900">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </template>
    <button type="button" @click="categories.push('')"
        class="mt-2 inline-flex items-center px-3 py-1 border border-indigo-600 rounded-md text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Add Category
    </button>
    @error('categories')
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
    @error('categories.*')
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>
