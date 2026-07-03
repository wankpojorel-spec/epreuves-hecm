@extends('layouts.admin')

@section('titre', 'Gestion des documents')

@section('contenu')
    <h2 class="mb-3">Gestion des documents</h2>

    <form method="GET" class="mb-3">
        <input type="text" name="recherche" value="{{ request('recherche') }}" class="form-control" placeholder="Rechercher par titre ou matière...">
    </form>

    <div class="table-responsive bg-white rounded shadow-sm">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Titre</th>
                    <th>Filière</th>
                    <th>Niveau</th>
                    <th>Matière</th>
                    <th>Année</th>
                    <th>Type</th>
                    <th>Ajouté le</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($documents as $doc)
                    <tr>
                        <td>{{ $doc->titre }}</td>
                        <td>{{ $doc->filiere }}</td>
                        <td>{{ $doc->niveau }}</td>
                        <td>{{ $doc->matiere }}</td>
                        <td>{{ $doc->annee_academique }}</td>
                        <td>
                            <span class="badge {{ $doc->type == 'epreuve' ? 'bg-primary' : 'bg-success' }}">
                                {{ $doc->type == 'epreuve' ? 'Épreuve' : 'Corrigé' }}
                            </span>
                        </td>
                        <td class="text-muted small">{{ $doc->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ $doc->url_fichier }}" target="_blank" class="btn btn-sm btn-outline-secondary">Voir</a>
                            <form method="POST" action="{{ route('admin.documents.supprimer', $doc) }}" class="d-inline" onsubmit="return confirm('Supprimer ce document ?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted py-3">Aucun document trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $documents->links() }}</div>
@endsection
