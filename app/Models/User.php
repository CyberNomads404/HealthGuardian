<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_birthday',
        'gender',
        'profile_id',
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
    ];

    //Relationships

    public function registers()
    {
        return $this->hasMany(Register::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    // Functions

    public function assignProfile(string $profileName): void
    {
        if ($profileName) {
            $profile = Profile::where('name', $profileName)->first();

            if ($profile) {
                $this->profile_id = $profile->id;
                $this->save();
            } else {
                throw new \Exception("Profile not found: {$profileName}");
            }
        }
    }

    public function hasProfile(string $profile): bool
    {
        return $this->profile()->where('name', $profile)->exists();
    }
}
