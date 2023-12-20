<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'region'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = [
        'role_name'
    ];

    /**
     * Роли
     * 1-админ
     * 2-тренер
     * 3-начальник
     * 4-судья
     */

    public function getRoleNameAttribute()
    {
        $name = '';

        switch ($this->role_id) {
            case 1:
                $name = "Администратор";
                break;
            case 2:
                $name = "Тренер";
                break;
            case 3:
                $name = "Начальник";
                break;
            case 4:
                $name = "Судья";
                break;
            default:
                break;

        }
        return $name;
    }
}
