{{-- resources/views/components/image-upload.blade.php --}}
@props(['name', 'value' => null, 'label' => 'Image'])

@php
    $previewUrl = null;
    if ($value) {
        $previewUrl = asset($value);
    }
@endphp

<div x-data="imageUpload({
    name: '{{ $name }}',
    value: '{{ $value }}',
    preview: '{{ old($name, $previewUrl) }}'
})">
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>

    <div class="mt-1 flex items-center space-x-4">
        {{-- Preview --}}
        <div class="relative" x-show="preview">
            <img :src="preview" class="h-32 w-32 object-cover rounded-lg">
            <button type="button" @click="removeImage"
                class="absolute -top-2 -right-2 rounded-full bg-red-500 text-white p-1 hover:bg-red-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Upload Button --}}
        <div x-show="!preview" class="flex justify-center items-center">
            <label
                class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                <span class="px-4 py-2 rounded border border-gray-300 dark:border-gray-600">Select Image</span>
                <input type="file" :name="name" class="sr-only" accept="image/*"
                    @change="handleImageSelected">
            </label>
        </div>
    </div>

    <p class="mt-2 text-sm text-gray-500" x-show="!preview">PNG, JPG, GIF up to 2MB</p>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('imageUpload', ({
            name,
            value,
            preview
        }) => ({
            name,
            preview,

            handleImageSelected(event) {
                const file = event.target.files[0];
                if (file) {
                    this.preview = URL.createObjectURL(file);
                }
            },

            removeImage() {
                this.preview = null;
                // Reset file input
                const input = this.$el.querySelector('input[type="file"]');
                input.value = '';
            }
        }));
    });
</script>
