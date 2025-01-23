{{-- resources/views/components/multiple-image-upload.blade.php --}}
<div x-data="multipleImageUpload({
    name: '{{ $name }}',
    images: {{ json_encode(old($name, $images ?? [])) }},
    maxFiles: {{ $maxFiles ?? 5 }},
    maxFileSize: {{ $maxFileSize ?? 2048 }}, // KB
})" class="relative">
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ $label ?? 'Images' }}</label>

    {{-- Dropzone --}}
    <div @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false" @drop.prevent="handleDrop($event)"
        :class="{ 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20': isDragging }"
        class="relative p-4 border-2 border-dashed rounded-lg transition-all duration-200 dark:border-gray-600">

        {{-- Preview Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4" x-show="images.length">
            <template x-for="(image, index) in images" :key="index">
                <div class="relative group aspect-square">
                    <img :src="getImageUrl(image)" class="w-full h-full object-cover rounded-lg">

                    {{-- Remove Button --}}
                    <button @click="removeImage(index)" type="button"
                        class="absolute top-2 right-2 p-1 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    {{-- Progress Bar (for uploads) --}}
                    <div x-show="image.progress" class="absolute bottom-0 left-0 right-0 h-1 bg-gray-200">
                        <div class="h-full bg-indigo-500 transition-all duration-300"
                            :style="{ width: `${image.progress}%` }"></div>
                    </div>
                </div>
            </template>
        </div>

        {{-- Upload Area --}}
        <div class="flex flex-col items-center justify-center py-8" x-show="images.length < maxFiles">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Drag and drop your images here, or</p>
            <label class="mt-2 cursor-pointer">
                <span
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700">
                    Browse Files
                </span>
                <input type="file" class="hidden" :name="name + '[]'" @change="handleFileSelect" multiple
                    accept="image/*">
            </label>
            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                PNG, JPG, GIF up to {{ $maxFileSize / 1024 }}MB (Max {{ $maxFiles }} files)
            </p>
        </div>

        {{-- Error Messages --}}
        <div x-show="errorMessage" x-text="errorMessage" class="mt-2 text-sm text-red-600 dark:text-red-400"></div>
    </div>

    {{-- Hidden Input for Existing Images --}}
    <template x-for="(image, index) in images" :key="index">
        <input type="hidden" :name="name + '_existing[]'" :value="image" x-show="typeof image === 'string'">
    </template>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('multipleImageUpload', ({
            name,
            images = [],
            maxFiles = 5,
            maxFileSize = 2048
        }) => ({
            name,
            images: Array.isArray(images) ? images : [],
            maxFiles,
            maxFileSize,
            isDragging: false,
            errorMessage: '',

            handleDrop(e) {
                this.isDragging = false;
                this.handleFiles(e.dataTransfer.files);
            },

            handleFileSelect(e) {
                this.handleFiles(e.target.files);
            },

            handleFiles(fileList) {
                const files = Array.from(fileList).filter(file => file.type.startsWith('image/'));

                if (this.images.length + files.length > this.maxFiles) {
                    this.errorMessage = `You can only upload up to ${this.maxFiles} images`;
                    return;
                }

                files.forEach(file => {
                    if (file.size > this.maxFileSize * 1024) {
                        this.errorMessage =
                            `File ${file.name} is too large. Max size is ${this.maxFileSize / 1024}MB`;
                        return;
                    }

                    this.images.push(file);
                    this.simulateUpload(this.images.length - 1);
                });
            },

            removeImage(index) {
                this.images.splice(index, 1);
            },

            simulateUpload(index) {
                const file = this.images[index];
                if (typeof file !== 'object' || !file.type) return;

                file.progress = 0;
                const interval = setInterval(() => {
                    file.progress += 10;
                    if (file.progress >= 100) {
                        clearInterval(interval);
                        setTimeout(() => {
                            file.progress = undefined;
                        }, 300);
                    }
                }, 100);
            },

            getImageUrl(image) {
                if (typeof image === 'string') {
                    return `{{ asset('${image}') }}`;
                }
                return URL.createObjectURL(image);
            }
        }));
    });
</script>
