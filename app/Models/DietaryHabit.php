<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietaryHabit extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_description',
        'calories',
    ];

    // RelationShips

    public function register()
    {
        return $this->morphOne(Register::class, 'register');
    }
}
