<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class CalendarResults extends Model
{
    use HasFactory, SoftDeletes;


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

        return $query;
    }

    public function scopeOrder($query, $order)
    {
        Log::error($order);
        return $query->orderBy('date_time','ASC');
    }
}
