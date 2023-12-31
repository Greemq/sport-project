<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use function Symfony\Component\String\s;

class CalendarResults extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date_time',
        'title',
        'state',
        'protocol',
        'status',
        'link',
        'type'
    ];

    /**
     * statuses
     * 1 = Ожидается
     * 2 = проходит
     * 3 = отменен
     * 4 = завершен
     *
     * type
     * 1 = международный
     * 2 = республиканский
     */
    public function scopeFilter($query, $filters)
    {
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }
        if (isset($filters['id'])) {
            $query->where('id', $filters['id']);
        }
        if (isset($filters['search']))
            $query->where(function ($q) use ($filters) {
                $q->where('id', 'like', '%' . $filters['search'] . '%')->orWhere('title', 'like', '%' . $filters['search'] . '%');
            });

        return $query;
    }

    public function scopeOrder($query, $order)
    {
        if (isset($order['date_time']))
            $query->orderBy('date_time', $order['date_time']);
        return $query;
    }

    public function athlete()
    {
        return $this->belongsToMany(Athlete::class)->withPivot('accepted');
    }

}
