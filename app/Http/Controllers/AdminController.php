<?php

namespace App\Http\Controllers;

use App\Models\Epreuve;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Dashboard avec statistiques générales.
     */
    public function dashboard()
    {
        $totalUtilisateurs = User::count();
        $totalDocuments = Epreuve::count();
        $totalEpreuves = Epreuve::where('type', 'epreuve')->count();
        $totalCorriges = Epreuve::where('type', 'corrige')->count();
        $derniersDocuments = Epreuve::latest()->take(5)->get();
        $derniersUtilisateurs = User::latest()->take(5)->get();

        // Répartition par filière (top 5)
        $parFiliere = Epreuve::selectRaw('filiere, count(*) as total')
            ->groupBy('filiere')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUtilisateurs',
            'totalDocuments',
            'totalEpreuves',
            'totalCorriges',
            'derniersDocuments',
            'derniersUtilisateurs',
            'parFiliere'
        ));
    }

    /**
     * Liste et gestion des documents.
     */
    public function documents(Request $request)
    {
        $query = Epreuve::query();

        if ($request->filled('recherche')) {
            $query->where('titre', 'like', '%' . $request->recherche . '%')
                  ->orWhere('matiere', 'like', '%' . $request->recherche . '%');
        }

        $documents = $query->latest()->paginate(15)->withQueryString();

        return view('admin.documents', compact('documents'));
    }

    /**
     * Suppression d'un document (fichier + entrée base de données).
     */
    public function supprimerDocument(Epreuve $epreuve)
    {
        $disk = Storage::disk('public');

        if ($epreuve->chemin_fichier && $disk->exists($epreuve->chemin_fichier)) {
            $disk->delete($epreuve->chemin_fichier);
        }

        $epreuve->delete();

        return back()->with('succes', 'Document supprimé.');
    }

    /**
     * Liste et gestion des utilisateurs.
     */
    public function utilisateurs(Request $request)
    {
        $query = User::query();

        if ($request->filled('recherche')) {
            $query->where('name', 'like', '%' . $request->recherche . '%')
                  ->orWhere('email', 'like', '%' . $request->recherche . '%');
        }

        $utilisateurs = $query->latest()->paginate(15)->withQueryString();

        return view('admin.utilisateurs', compact('utilisateurs'));
    }

    /**
     * Change le rôle d'un utilisateur (user <-> admin).
     */
    public function changerRole(User $user)
    {
        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return back()->with('succes', "Rôle de {$user->name} mis à jour : {$user->role}.");
    }

    /**
     * Suppression d'un utilisateur.
     */
    public function supprimerUtilisateur(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors('Vous ne pouvez pas vous supprimer vous-même.');
        }

        $user->delete();

        return back()->with('succes', 'Utilisateur supprimé.');
    }
}
