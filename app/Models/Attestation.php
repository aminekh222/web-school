<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attestation extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_attestation',
        'student_id',
        'type_attestation',
        'contenu',
        'date_emission',
        'statut',
        'fichier_pdf'
    ];

    protected $casts = [
        'date_emission' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
