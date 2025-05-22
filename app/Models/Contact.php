<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject',
        'message',
        'status',
        'response',
        'response_date'
    ];

    protected $casts = [
        'response_date' => 'datetime'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
} 