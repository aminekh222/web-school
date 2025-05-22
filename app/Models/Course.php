<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'semester'
    ];

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user')
            ->where('role', 'student');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
} 