<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    protected $fillable = [
        'link',
        'img',
        'title',
        'description',
        'date'
    ];

    protected $appends = ['img_url'];

    public function getImgUrlAttribute()
    {
        return url('/') . $this->img;
    }
}
