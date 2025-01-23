{{-- resources/views/components/project-drawer.blade.php --}}
<div x-data="projectDrawer" x-show="isOpen" x-cloak @keydown.escape.window="close"
    style="position: fixed; inset: 0; z-index: 9999; overflow: hidden;">

    <!-- Backdrop with blur effect -->
    <div @click="close" x-show="isOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 backdrop-blur-none" x-transition:enter-end="opacity-100 backdrop-blur-sm"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 backdrop-blur-sm"
        x-transition:leave-end="opacity-0 backdrop-blur-none"
        style="position: absolute; inset: 0; background-color: rgba(0,0,0,0.4); 
                backdrop-filter: blur(8px);">
    </div>

    <!-- Drawer -->
    <div x-show="isOpen" x-transition:enter="transform transition ease-out duration-500"
        x-transition:enter-start="translate-x-full rotate-3 opacity-0"
        x-transition:enter-end="translate-x-0 rotate-0 opacity-100"
        x-transition:leave="transform transition ease-in duration-300"
        x-transition:leave-start="translate-x-0 rotate-0 opacity-100"
        x-transition:leave-end="translate-x-full rotate-3 opacity-0"
        style="position: fixed; top: 0; bottom: 0; right: 0; width: 500px;">

        <div
            style="height: 100%; background: white; box-shadow: -5px 0 25px rgba(0,0,0,0.15); 
                    display: flex; flex-direction: column; position: relative;
                    border-left: 1px solid rgba(0,0,0,0.1);">

            <!-- Header -->
            <div class="drawer-header"
                style="position: sticky; top: 0; z-index: 10; padding: 24px;
                        background: rgba(255,255,255,0.95); backdrop-filter: blur(10px);
                        border-bottom: 1px solid #eee;">
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 20px;">
                    <h2 style="margin: 0; font-size: 1.75rem; font-weight: 700; color: #1a1a1a;
                               overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"
                        x-text="project?.title"></h2>
                    <button @click="close" class="close-button"
                        style="background: none; border: none; padding: 8px; cursor: pointer;
                                   border-radius: 50%; transition: all 0.3s ease;">
                        <svg style="width: 24px; height: 24px; color: #666;" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Project Link -->
                <a :href="project?.url" target="_blank"
                    style="display: inline-flex; align-items: center; gap: 8px;
                          margin-top: 12px; color: #0066cc; text-decoration: none;
                          font-size: 0.875rem; transition: color 0.2s ease;"
                    onmouseover="this.style.color='#004d99'" onmouseout="this.style.color='#0066cc'">
                    <span>View Project</span>
                    <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
            </div>

            <!-- Content -->
            <div style="flex: 1; overflow-y: auto; padding: 24px;">
                <!-- Image Carousel -->
                <div
                    style="position: relative; margin-bottom: 30px; border-radius: 16px; 
                           overflow: hidden; background: #f5f5f5; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                    <div style="position: relative; padding-top: 66.67%;">
                        <!-- Main Image with zoom effect -->
                        <div style="position: absolute; inset: 0; overflow: hidden;">
                            <img :src="currentImage" :alt="project?.title"
                                style="width: 100%; height: 100%; object-fit: cover; 
                                        transition: all 0.5s ease-out;"
                                :style="{
                                    opacity: isImageLoading ? '0' : '1',
                                    transform: isImageLoading ? 'scale(1.05)' : 'scale(1)'
                                }"
                                @load="isImageLoading = false">
                        </div>

                        <!-- Loading Indicator -->
                        <div x-show="isImageLoading"
                            style="position: absolute; inset: 0; background: #f0f0f0; overflow: hidden;">
                            <div style="width: 100%; height: 100%; 
                                        background: linear-gradient(90deg, #f0f0f0 0%, #f8f8f8 50%, #f0f0f0 100%);
                                        background-size: 200% 100%;
                                        animation: shimmer 1.5s infinite linear;"
                                @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position:
                                200% 0; } }>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <template x-if="hasMultipleImages">
                        <div>
                            <!-- Previous Button -->
                            <button @click="prevImage" class="nav-button"
                                style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
                                           padding: 12px; background: rgba(255,255,255,0.9); border: none; 
                                           border-radius: 50%; cursor: pointer; transition: all 0.3s ease;
                                           box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                                <svg style="width: 20px; height: 20px; color: #333;" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>

                            <!-- Next Button -->
                            <button @click="nextImage" class="nav-button"
                                style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%);
                                           padding: 12px; background: rgba(255,255,255,0.9); border: none; 
                                           border-radius: 50%; cursor: pointer; transition: all 0.3s ease;
                                           box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                                <svg style="width: 20px; height: 20px; color: #333;" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>

                            <!-- Image Indicators -->
                            <div
                                style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%);
                                       display: flex; gap: 8px; padding: 8px 16px; background: rgba(0,0,0,0.3);
                                       backdrop-filter: blur(4px); border-radius: 20px;">
                                <template x-for="(_, index) in project.additionalImages" :key="index">
                                    <button @click="currentImageIndex = index"
                                        :style="{
                                            width: currentImageIndex === index ? '24px' : '8px',
                                            height: '8px',
                                            borderRadius: '4px',
                                            background: currentImageIndex === index ? 'white' : 'rgba(255,255,255,0.5)',
                                            border: 'none',
                                            cursor: 'pointer',
                                            transition: 'all 0.3s ease'
                                        }">
                                    </button>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Description -->
                <div style="margin-bottom: 30px;">
                    <p style="margin: 0; line-height: 1.8; color: #333; font-size: 1rem;" x-text="project?.description">
                    </p>
                </div>

                <!-- Categories -->
                <template x-if="project?.categories?.length">
                    <div style="margin-bottom: 24px;">
                        <h5
                            style="margin: 0 0 12px 0; font-size: 0.875rem; font-weight: 600; 
                                  color: #666; text-transform: uppercase; letter-spacing: 0.5px;">
                            Categories
                        </h5>
                        <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                            <template x-for="category in project.categories" :key="category">
                                <span
                                    style="padding: 6px 16px; background: #f5f5f5; color: #333; 
                                           border-radius: 20px; font-size: 0.875rem;
                                           border: 1px solid #eee; font-weight: 500;"
                                    x-text="category"></span>
                            </template>
                        </div>
                    </div>
                </template>

                <!-- Tags -->
                <template x-if="project?.tags?.length">
                    <div>
                        <h5
                            style="margin: 0 0 12px 0; font-size: 0.875rem; font-weight: 600; 
                                  color: #666; text-transform: uppercase; letter-spacing: 0.5px;">
                            Tags
                        </h5>
                        <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                            <template x-for="tag in project.tags" :key="tag">
                                <span
                                    style="padding: 6px 16px; background: #e6f3ff; color: #0066cc; 
                                           border-radius: 20px; font-size: 0.875rem; font-weight: 500;"
                                    x-text="tag"></span>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-button:hover {
        background: white !important;
        transform: translateY(-50%) scale(1.1) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2) !important;
    }

    .close-button:hover {
        background: #f5f5f5;
        transform: rotate(90deg);
    }

    .drawer-header {
        animation: slideDown 0.5s ease-out;
    }

    @keyframes slideDown {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    [x-cloak] {
        display: none !important;
    }
</style>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('projectDrawer', () => ({
            isOpen: false,
            project: null,
            currentImageIndex: 0,
            isImageLoading: true,

            init() {
                window.addEventListener('show-project', (event) => {
                    this.project = event.detail;
                    this.isOpen = true;
                    this.currentImageIndex = 0;
                    this.isImageLoading = true;
                });
            },

            close() {
                this.isOpen = false;
                setTimeout(() => {
                    this.project = null;
                    this.currentImageIndex = 0;
                }, 500);
            },

            get currentImage() {
                return this.project?.additionalImages?.[this.currentImageIndex] || this.project
                    ?.mainImage;
            },

            get hasMultipleImages() {
                return this.project?.additionalImages?.length > 0;
            },

            prevImage() {
                if (this.hasMultipleImages) {
                    this.isImageLoading = true;
                    this.currentImageIndex = (this.currentImageIndex - 1 + this.project
                        .additionalImages.length) % this.project.additionalImages.length;
                }
            },

            nextImage() {
                if (this.hasMultipleImages) {
                    this.isImageLoading = true;
                    this.currentImageIndex = (this.currentImageIndex + 1) % this.project
                        .additionalImages.length;
                }
            }
        }));
    });
</script>
