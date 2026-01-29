<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
        'Role'
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

    public function Enrollments()
    {
        return $this->hasMany(Enrollment::class, 'UserId');
    }

    public function CompletedKeuzedelen()
    {
        return $this->hasMany(CompletedKeuzedeel::class, 'UserId');
    }

    public function HasCompleted($keuzdeelCode)
    {
        return $this->CompletedKeuzedelen()
            ->where('KeuzdeelCode', $keuzdeelCode)
            ->exists();
    }

    public function IsEnrolledInPeriod($periode)
    {
        return $this->Enrollments()
            ->whereHas('Keuzedeel', function ($query) use ($periode) {
                $query->where('Periode', $periode);
            })
            ->where('Status', 'enrolled')
            ->exists();
    }
}
