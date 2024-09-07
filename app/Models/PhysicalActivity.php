<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_description',
        'duration',
    ];

    // RelationShips

    public function register()
    {
        return $this->morphOne(Register::class, 'register');
    }
}
