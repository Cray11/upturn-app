<?php
namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles;
    protected $fillable = ['name','email','password','role','is_active'];
    protected $hidden   = ['password','remember_token'];
    protected $casts    = ['email_verified_at'=>'datetime','is_active'=>'boolean','password'=>'hashed'];

    protected static function booted(): void
    {
        static::saved(function (self $user): void {
            if (blank($user->role)) {
                $user->syncRoles([]);

                return;
            }

            $user->syncRoles([$user->role]);
        });
    }

    public function posts()       { return $this->hasMany(Post::class); }
    public function bookings()    { return $this->hasMany(Booking::class); }
    public function inquiries()   { return $this->hasMany(Inquiry::class, 'assigned_to'); }
    public function jobPostings() { return $this->hasMany(JobPosting::class, 'created_by'); }
    public function media()       { return $this->hasMany(Media::class); }

    public function hasPortalRole(array $roles): bool
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role) || $this->role === $role) {
                return true;
            }
        }

        return false;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if (! $this->is_active) {
            return false;
        }

        return match ($panel->getId()) {
            'admin' => $this->hasPortalRole(['admin', 'staff']),
            'hr' => $this->hasPortalRole(['admin', 'hr']),
            default => false,
        };
    }
}
