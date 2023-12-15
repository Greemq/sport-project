<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'img',
        'user_id',
        'is_published',
        'publish_date',
    ];

    protected $appends = ['thumb_image'];

    public function getThumbImageAttribute()
    {
        return '';
    }
}
