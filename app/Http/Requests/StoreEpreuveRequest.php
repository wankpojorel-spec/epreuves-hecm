<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEpreuveRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Dépôt accessible aux utilisateurs connectés (comme défini dans routes)
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'filiere' => ['required', 'string', 'max:255'],
            'niveau' => ['required', 'string', 'max:50'],
            'matiere' => ['required', 'string', 'max:255'],
            'annee_academique' => ['required', 'string', 'max:20'],
            'type' => ['required', 'in:epreuve,corrige'],
            'fichier' => ['required', 'file', 'mimes:pdf', 'max:10240'], // 10Mo
        ];
    }

    public function messages(): array
    {
        return [
            'fichier.mimes' => 'Le fichier doit être un PDF.',
            'fichier.max' => 'Le fichier est trop volumineux (max : 10 Mo).',
        ];
    }
}

