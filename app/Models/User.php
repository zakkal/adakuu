<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'google_id', 'avatar'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Get user avatar URL
     * Priority: Google Avatar > Gravatar > UI Avatars with colors
     */
    public function getAvatarUrlAttribute(): string
    {
        // Priority 1: Use Google Avatar if exists (even if from googleusercontent.com)
        // Will fallback in browser if it fails to load
        if ($this->avatar) {
            return $this->avatar;
        }

        // Priority 2: Try Gravatar
        if ($this->email) {
            $hash = md5(strtolower(trim($this->email)));
            return "https://www.gravatar.com/avatar/{$hash}?s=200&d=404";
        }

        // Priority 3: Colored UI Avatars
        return $this->getColoredAvatarUrl();
    }

    /**
     * Get colored avatar URL based on email hash
     */
    public function getColoredAvatarUrl(): string
    {
        if ($this->email) {
            $hash = md5(strtolower(trim($this->email)));
            
            $colors = ['e11d48', '059669', '2563eb', 'ea580c', '7c3aed', 'db2777', '0891b2', 'ca8a04'];
            $bgColors = ['fecdd3', 'd1fae5', 'dbeafe', 'fed7aa', 'ede9fe', 'fbcfe8', 'cffafe', 'fef3c7'];
            
            $index = hexdec(substr($hash, 0, 1)) % count($colors);
            $initials = $this->name;
            
            return "https://ui-avatars.com/api/?name=" . urlencode($initials) 
                 . "&color=" . $colors[$index] 
                 . "&background=" . $bgColors[$index]
                 . "&size=200&bold=true";
        }

        return "https://ui-avatars.com/api/?name=" . urlencode($this->name) . "&color=dc2626&background=fef2f2&size=200";
    }
}
