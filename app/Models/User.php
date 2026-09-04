<?php

namespace App\Models;

use Filament\Panel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    // Role constants
    const ROLE_ADMIN = 'ADMIN';
    const ROLE_USER = 'USER';
    const ROLE_DEFAULT = self::ROLE_USER;

    const ROLES = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_USER => 'User',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'google_id',
        'email_verified_at',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'google_id',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Role Management
    public function setRoleAttribute($value)
    {
        $value = strtoupper(trim($value));
        $this->attributes['role'] = array_key_exists($value, self::ROLES)
            ? $value
            : self::ROLE_DEFAULT;
    }

    public function isAdmin(): bool
    {
        return strtoupper($this->role) === self::ROLE_ADMIN;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin() || strtoupper($this->role) === self::ROLE_USER;
    }

    // Social Login Helpers
    public static function findByGoogleIdOrEmail($googleUser)
    {
        return self::firstWhere('google_id', $googleUser->getId())
            ?? self::firstWhere('email', $googleUser->getEmail());
    }

    public function updateGoogleData($googleUser): void
    {
        $this->update([
            'google_id' => $googleUser->getId(),
            'email_verified_at' => $this->email_verified_at ?? now(),
        ]);
    }
}
