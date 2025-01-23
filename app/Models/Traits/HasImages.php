<?php

namespace App\Models\Traits;

trait HasImages
{
    /**
     * Get the proper path for an image
     */
    protected function getImagePath(?string $path): string
    {
        if (empty($path)) {
            return '';
        }

        if (str_starts_with($path, 'http')) {
            return $path;
        }

        return str_starts_with($path, 'services/') ||
            str_starts_with($path, 'projects/') ||
            str_starts_with($path, 'products/') ||
            str_starts_with($path, 'slides/')
            ? "storage/$path"
            : $path;
    }

    /**
     * Get array of image paths
     */
    protected function getImagePaths(?array $paths): array
    {
        if (empty($paths)) {
            return [];
        }

        return array_map(fn($path) => $this->getImagePath($path), $paths);
    }
}