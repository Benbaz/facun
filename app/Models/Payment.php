<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function candidatConcours()
    {
        return $this->belongsTo(CandidatConcours::class);
    }
}
