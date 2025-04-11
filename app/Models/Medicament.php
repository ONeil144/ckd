<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'posologie', 'traitement_id'];

    public function traitement()
    {
        return $this->belongsTo(Traitement::class);
    }
}

