<?php

namespace App\Models;

use App\Models\Traits\HasImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory, HasImages;

    protected $fillable = [
        'image',
        'categories',
        'title',
        'link',
        'description',
        'additional_images'
    ];

    protected $casts = [
        'categories' => 'array',
        'additional_images' => 'array'
    ];

    public function getMainImage(): string
    {
        return $this->getImagePath($this->image);
    }

    public function getAdditionalImages(): array
    {
        return $this->getImagePaths($this->additional_images);
    }
}