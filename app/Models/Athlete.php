<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

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
        Log::error($filters);
        if (isset($filters['search']))
            $query->where(function ($q) use ($filters) {
                $q->where('fio', 'like', '%' . $filters['search'] . '%')->orWhere('personal_id', 'like', '%' . $filters['search'] . '%');
            });

        return $query;
    }
}
