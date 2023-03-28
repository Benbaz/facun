<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class elections extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'date_debut',
        'date_fin',
    ];

    public function candidats()
    {
        return $this->hasMany(Candidat::class);
    }
}
