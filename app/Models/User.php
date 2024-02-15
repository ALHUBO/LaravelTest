<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail; //descomentar para importar

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Relations\HasMany;//si se usa la abreviacion en funcion :HasMany

class User extends Authenticatable// implements MustVerifyEmail //MustVerifyEmail para activar 'verified' en Route web middleware
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

	//public function pubs():\Illuminate\Database\Eloquent\Relations\HasMany
	public function pubs():HasMany
	{
		return $this->hasMany(Pub::class); //relacion uno a muchos
	}
}
