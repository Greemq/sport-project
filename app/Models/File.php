<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'type',
        'date_time',
        'file'
    ];

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['type']))
            $query->where('type', $filters['type']);
        return $query;
    }

}
