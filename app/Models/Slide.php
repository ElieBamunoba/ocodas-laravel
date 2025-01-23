<?php

namespace App\Models;

use App\Models\Traits\HasImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    /** @use HasFactory<Database\Factories\SlideFactory> */
    use HasFactory, HasImages;

    protected $fillable = [
        'title',
        'description',
        'img',
    ];

    public function getMainImage(): string
    {
        return $this->getImagePath($this->img);
    }

}