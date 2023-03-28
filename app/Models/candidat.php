<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class candidat extends Model
{
    use HasFactory;
    protected $table = 'candidats';

    protected $fillable = [
        'nom',
        'prenom',
        'tel',
        'etablissement_id',
        'election_id',
        'photo',
        'video',
    ];

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function election()
    {
        return $this->belongsTo(elections::class);
    }

    public static function filter($nom, $etablissement_id, $election_id, $type)
    {
        $query = self::query();

        if (!empty($nom)) {
            $query->where('nom', 'like', '%' . $nom . '%');
        }

        if (!empty($etablissement_id)) {
            $query->where('etablissement_id', $etablissement_id);
        }

        if (!empty($election_id)) {
            $query->where('election_id', $election_id);
        }

        if (!empty($type)) {
            $query->where('type', $type);
        }

        return $query->get();
    }
    
}
