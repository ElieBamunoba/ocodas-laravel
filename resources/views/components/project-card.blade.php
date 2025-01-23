{{-- resources/views/components/project-card.blade.php --}}
<div x-data class="featured-imagebox featured-imagebox-portfolio" style="cursor: pointer"
    @click="$dispatch('show-project', {
        id: {{ $project->id }},
        title: '{{ addslashes($project->title) }}',
        description: '{{ addslashes($project->description) }}',
        mainImage: '{{ asset($project->getMainImage()) }}',
        additionalImages: {{ json_encode($project->getAdditionalImages()) }},
        categories: {{ json_encode($project->categories) }},
        tags: {{ json_encode($project->tags ?? []) }},
        url: '{{ $project->link }}',
    })">
    <div class="featured-thumbnail">
        <img class="img-fluid" src="{{ asset($project->getMainImage()) }}" alt="{{ $project->title }}">
    </div>
    <div class="ttm-box-view-overlay ttm-portfolio-box-view-overlay">
        <div class="ttm-box-view-content-inner">
            <div class="featured-content featured-content-portfolio">
                <span class="category">
                    {{ implode(', ', $project->categories) }}
                </span>
                <h2 class="featured-title" style="font-size: 1rem">
                    {{ $project->title }}
                </h2>
            </div>
        </div>
    </div>
</div>
