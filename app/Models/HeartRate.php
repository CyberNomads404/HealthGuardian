<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeartRate extends Model
{
    use HasFactory;

    protected $table = 'heart_rates';

    protected $fillable = ['heart_rate'];

    protected $casts = [
        'heart_rate' => 'integer',
    ];

    // RelationShips

    public function register()
    {
        return $this->morphOne(Register::class, 'register');
    }
}
