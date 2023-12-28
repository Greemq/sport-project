<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhotoGallery extends Model
{
    protected $table = 'photogallery';

    protected $fillable = [
        'path',
    ];

    protected $appends = ['img_url'];

    public function getImgUrlAttribute()
    {
        return url('/') . $this->path;
    }
}
