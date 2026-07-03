<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epreuve extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'filiere',
        'niveau',
        'matiere',
        'annee_academique',
        'type',
        'chemin_fichier',
        'nom_original',
    ];

    // Renvoie l'URL publique du fichier PDF (nécessite php artisan storage:link)
    public function getUrlFichierAttribute(): string
    {
        return asset('storage/' . $this->chemin_fichier);
    }
}
