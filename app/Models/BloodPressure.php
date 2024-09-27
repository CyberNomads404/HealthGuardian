<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodPressure extends Model
{
    use HasFactory;

    protected $table = 'blood_pressures';

    protected $fillable = ['systolic_pressure', 'diastolic_pressure'];

    protected $casts = [
        'systolic_pressure' => 'integer',
        'diastolic_pressure' => 'integer',
    ];

    // RelationShips

    public function register()
    {
        return $this->morphOne(Register::class, 'register');
    }
}
