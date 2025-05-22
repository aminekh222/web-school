<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'is_important',
        'expiry_date',
    ];

    protected $casts = [
        'is_important' => 'boolean',
        'expiry_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 