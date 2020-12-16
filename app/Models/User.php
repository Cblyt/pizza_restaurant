<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'date_of_birth',
        'address_houseno',
        'address_streetname',
        'address_postcode',
        'password',
        'hash',
        'active',
        'two_factor_code',
        'two_factor_code_expires_at',
    ];

    protected $dates = [
        'date_of_birth',
        'two_factor_code_expires_at',
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
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function generateTwoFactorCode()
    {   
        $this->two_factor_code = sprintf("%06d", mt_rand(1, 999999));
        $this->two_factor_code_expires_at = now()->addMinutes(10);
        $this->save();
    }

    public function clearTwoFactorCode()
    {
        $this->two_factor_code = null;
        $this->two_factor_code_expires_at = null;
        $this->save();
    }

    public function generateVerificationHash()
    {
        $this->hash = md5(rand(0,1000));
        $this->save();
    }

    public function attemptLogin($credentials)
    {
        return Auth::attempt($credentials);
    }
}
