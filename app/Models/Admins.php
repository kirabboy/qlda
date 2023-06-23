<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\AdminRole;
use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admins extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'admins';
    protected $fillable = [
        'username',
        'fullname',
        'email',
        'phone',
        'birthday',
        'gender',
        'avatar',
        'address',
        'email_verified_at',
        'password',
        'remember_token',
        'roles'
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
        'roles' => AdminRole::class,
        'gender'=> Gender::class,
    ];

    public function projects(){
        return $this->hasOne(Projects::class, 'admin_id');
    }

    public function employee(){
        return $this->hasOne(Employee::class, 'admin_id');
    }
}

