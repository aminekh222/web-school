<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'description',
        'is_active'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
} 