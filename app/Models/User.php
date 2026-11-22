<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'level',
        'email',
        'username',
        'no_telepon',
        'alamat',
        'password',
        'email_verified_at',
        'verification_code',
        'verification_expires_at',
        'verification_sent_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
    ];

    // Laravel 11+
    protected function casts(): array
    {
        return [
            'email_verified_at'       => 'datetime',
            'verification_expires_at' => 'datetime',
            'verification_sent_at'    => 'datetime',
            'password'                => 'hashed',
        ];
    }

    public function hasVerifiedEmail(): bool
    {
        return $this->email_verified_at !== null;
    }
}