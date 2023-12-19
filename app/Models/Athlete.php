<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Athlete extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'fio',
        'location',
        'personal_id',
        'category',
        'file',
        'type',
        'class'

    ];

    public function calendarResults()
    {
        return $this->belongsToMany(CalendarResults::class)->withTimestamps();
    }

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['search']))
            $query->where('fio', '%' . $filters['search'] . '%');
        return $query;
    }
}
