<?php

namespace App\Models;

use App\Services\MarketService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const PINPATH = 'login/pin';
    const KINNTEGRA_ADMIN = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_id',
        'grant_type',
        'access_token',
        'refresh_token',
        'token_expires_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function getNameAttribute()
    {
        $marketService = resolve(MarketService::class);

        $userInformation = $marketService->getUserInformation();

        return $userInformation->name;
    }

    public function getInhouseAttribute()
    {
        $marketService = resolve(MarketService::class);

        $userInformation = $marketService->getUserInformation();

        return $userInformation->in_house;
    }


    public function hasRole($role)
    {
        $marketService = resolve(MarketService::class);

        $userInformation = $marketService->getUserInformation();

        if (in_array(strtolower($role), $userInformation->role)) {
            return true;
        }
        return false;
        //@if (Auth::user()->hasRole("Super"))
    }
}
