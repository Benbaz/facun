<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidatExament extends Model
{
    use HasFactory;
    protected $table = 'candidat_examents';

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'fiche',
        'acte',
        'diplome',
        'photos',
        'certificat',
        'address_envelope',
        'numero_mobile_money',
    ];
}
