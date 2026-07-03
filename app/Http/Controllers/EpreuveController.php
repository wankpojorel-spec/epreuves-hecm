<?php

namespace App\Http\Controllers;

use App\Models\Epreuve;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EpreuveController extends Controller
{
    /**
     * Liste des épreuves avec recherche/filtres.
     */
    public function index(Request $request)
    {
        $query = Epreuve::query();

        if ($request->filled('filiere')) {
            $query->where('filiere', 'like', '%' . $request->filiere . '%');
        }
        if ($request->filled('niveau')) {
            $query->where('niveau', $request->niveau);
        }
        if ($request->filled('matiere')) {
            $query->where('matiere', 'like', '%' . $request->matiere . '%');
        }
        if ($request->filled('annee_academique')) {
            $query->where('annee_academique', $request->annee_academique);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $epreuves = $query->latest()->paginate(12)->withQueryString();

        // Listes distinctes pour peupler les filtres
        $niveaux = Epreuve::select('niveau')->distinct()->pluck('niveau');
        $matieres = Epreuve::select('matiere')->distinct()->pluck('matiere');
        $annees = Epreuve::select('annee_academique')->distinct()->orderByDesc('annee_academique')->pluck('annee_academique');

        return view('epreuves.index', compact('epreuves', 'niveaux', 'matieres', 'annees'));
    }

    /**
     * Formulaire de dépôt.
     */
    public function create()
    {
        return view('epreuves.create');
    }

    /**
     * Enregistrement d'une nouvelle épreuve/corrigé.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'filiere' => 'required|string|max:255',
            'niveau' => 'required|string|max:50',
            'matiere' => 'required|string|max:255',
            'annee_academique' => 'required|string|max:20',
            'type' => 'required|in:epreuve,corrige',
            'fichier' => 'required|file|mimes:pdf|max:10240', // 10 Mo max, PDF uniquement
        ]);

        $fichier = $request->file('fichier');
        $nomOriginal = $fichier->getClientOriginalName();
        $nomStocke = Str::uuid() . '.pdf';

        // Stocke le fichier dans storage/app/public/epreuves
        $chemin = $fichier->storeAs('epreuves', $nomStocke, 'public');

        Epreuve::create([
            'titre' => $validated['titre'],
            'filiere' => $validated['filiere'],
            'niveau' => $validated['niveau'],
            'matiere' => $validated['matiere'],
            'annee_academique' => $validated['annee_academique'],
            'type' => $validated['type'],
            'chemin_fichier' => $chemin,
            'nom_original' => $nomOriginal,
        ]);

        return redirect()->route('epreuves.index')->with('succes', 'Votre document a bien été ajouté. Merci pour votre contribution !');
    }
}
