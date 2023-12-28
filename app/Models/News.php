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

    protected $appends = ['thumb_image', 'img_url'];

    public function getThumbImageAttribute()
    {
        return url('/') . 'storage/news/thumb_' . basename($this->img);
    }

    public function getImgUrlAttribute()
    {
        return url('/') . $this->img;
    }

    public function scopeFilter($query, $filter)
    {
        if (isset($filter['is_published']))
            $query->where('is_published', $filter['is_published']);
        return $query;
    }
}
