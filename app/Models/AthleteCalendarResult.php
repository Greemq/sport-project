<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AthleteCalendarResult extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'accepted',
        'place'
    ];

    public function athlete()
    {
        return $this->belongsTo(Athlete::class);
    }

    public function calendarResults()
    {
        return $this->belongsTo(CalendarResults::class);
    }

    public function scopeFilter($query, $filter)
    {
        if (isset($filter['accepted']))
            $query->where('accepted', $filter['accepted'] == true ? 1 : null);
        else
            $query->whereNull('accepted');
        return $query;
    }
}
