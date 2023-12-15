<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id_employee';

    protected $fillable = [
        'username',
        'password',
        'fullname',
        'position',
        'gender',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function presence() {
        return $this->hasOne(Presence::class);
    }

    public function pengajuanIzin() {
        return $this->hasOne(PengajuanIzin::class);
    }
}

