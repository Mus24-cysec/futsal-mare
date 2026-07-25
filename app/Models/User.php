<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany; // Tambahkan import ini
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * 🏆 Relasi One-to-One ke Model Membership
     * Menghubungkan user dengan tingkatan tier loyalitas mereka.
     */
    public function membership(): HasOne
    {
        return $this->hasOne(Membership::class);
    }

    /**
     * 📅 Relasi One-to-Many ke Model Reservasi
     * Menghubungkan user dengan daftar riwayat pemesanan lapangan futsal.
     */
    public function reservasis(): HasMany
    {
        return $this->hasMany(Reservasi::class);
    }
}