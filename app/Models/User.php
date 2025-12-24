<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRole;
use App\Enums\UserTypeEnum;
use App\Models\UserRole as ModelsUserRole;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable implements FilamentUser, HasTenants
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
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
        'type'
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
            'type' => UserTypeEnum::class,
        ];
    }

    public function roles(): HasMany
    {
        return $this->hasMany(ModelsUserRole::class, 'user_id');
    }

    private function isAdmin()
    {
        if ($this->email == 'dipeshmurmu7@gmail.com') {
            return true;
        }
        return false;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin();
    }

    public function getTenants(Panel $panel): Collection
    {
        return collect([$this->organizer]);
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->organizer->id === $tenant->id;
    }

    public function kyc(): HasOne
    {
        return $this->hasOne(KYC::class, 'user_id');
    }

    public function organizer()
    {
        return $this->hasOne(Organizer::class, 'user_id');
    }

    public function reservations()
    {
        return $this->hasMany(TicketReservation::class, 'user_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }
}
