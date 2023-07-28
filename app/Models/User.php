<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'grant_id',
        'national_id',
        'national_type',
        'gasoline_station_id',
        'state'
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

    public function grant(): HasOne {
        return $this->hasOne(UserGrant::class,'id', 'grant_id');
    }

    public function company(): HasOne {
        return $this->hasOne(GasolineStation::class, 'id', 'gasoline_station_id');
    }

    /**
     * Find the user instance for the given username.
     */
    public function findForPassport(string $username)
    {
        return $this->where('national_id', $username)->first();
    }


}
