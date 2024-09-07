<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'register_type',
        'register_id',
        'date',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($register) {
            if ($register->registerable) {
                $register->registerable->delete();
            }
        });
    }

    // RelationShips

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function registerable() {
        return $this->morphTo('register');
    }
}
