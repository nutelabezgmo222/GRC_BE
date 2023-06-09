<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Models\Risk;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'u_name',
        'u_surname',
        'u_email',
        'u_password',
        'u_registration_date',
        'last_log_time',
        'is_admin',
        'r_access_level',
        'cntrl_access_level',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'u_password',
    ];

    protected $appends = ['full_name', 'objType'];

    public $timestamps = false;

    public function approvedRisks() {
        return $this->hasMany(Risk::class, 'approved_by');
    }

    public function getFullNameAttribute() {
        return $this->u_name . ' ' . $this->u_surname;
    }

    public function getObjTypeAttribute() {
        return 'user';
    }
}
