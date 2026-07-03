@extends('layouts.admin')

@section('titre', 'Dashboard Admin')

@section('contenu')
    <h2 class="mb-4">Tableau de bord</h2>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center p-3 shadow-sm">
                <h3 class="mb-0">{{ $totalUtilisateurs }}</h3>
                <span class="text-muted small">Utilisateurs inscrits</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3 shadow-sm">
                <h3 class="mb-0">{{ $totalDocuments }}</h3>
                <span class="text-muted small">Documents au total</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3 shadow-sm">
                <h3 class="mb-0 text-primary">{{ $totalEpreuves }}</h3>
                <span class="text-muted small">Épreuves</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3 shadow-sm">
                <h3 class="mb-0 text-success">{{ $totalCorriges }}</h3>
                <span class="text-muted small">Corrigés</span>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">Derniers documents ajoutés</div>
                <ul class="list-group list-group-flush">
                    @forelse ($derniersDocuments as $doc)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $doc->titre }}</span>
                            <span class="text-muted small">{{ $doc->created_at->diffForHumans() }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Aucun document pour l'instant.</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">Derniers utilisateurs inscrits</div>
                <ul class="list-group list-group-flush">
                    @forelse ($derniersUtilisateurs as $u)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $u->name }}</span>
                            <span class="text-muted small">{{ $u->created_at->diffForHumans() }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Aucun utilisateur pour l'instant.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-3">
        <div class="card-header">Top 5 filières les plus actives</div>
        <ul class="list-group list-group-flush">
            @forelse ($parFiliere as $f)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $f->filiere }}</span>
                    <span class="badge bg-primary">{{ $f->total }}</span>
                </li>
            @empty
                <li class="list-group-item text-muted">Pas encore de données.</li>
            @endforelse
        </ul>
    </div>
@endsection
