@extends('layouts.app')

@section('titre', 'Rechercher une épreuve')

@section('contenu')
    <h2 class="mb-3">Rechercher une épreuve ou un corrigé</h2>

    <form method="GET" action="{{ route('epreuves.index') }}" class="row g-2 mb-4 bg-white p-3 rounded shadow-sm">
        <div class="col-md-3">
            <input type="text" name="filiere" value="{{ request('filiere') }}" class="form-control" placeholder="Filière">
        </div>
        <div class="col-md-2">
            <select name="niveau" class="form-select">
                <option value="">Niveau</option>
                @foreach ($niveaux as $niveau)
                    <option value="{{ $niveau }}" @selected(request('niveau') == $niveau)>{{ $niveau }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="text" name="matiere" value="{{ request('matiere') }}" class="form-control" placeholder="Matière">
        </div>
        <div class="col-md-2">
            <select name="annee_academique" class="form-select">
                <option value="">Année</option>
                @foreach ($annees as $annee)
                    <option value="{{ $annee }}" @selected(request('annee_academique') == $annee)>{{ $annee }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="type" class="form-select">
                <option value="">Type</option>
                <option value="epreuve" @selected(request('type') == 'epreuve')>Épreuve</option>
                <option value="corrige" @selected(request('type') == 'corrige')>Corrigé</option>
            </select>
        </div>
        <div class="col-md-1 d-grid">
            <button class="btn btn-dark">🔍</button>
        </div>
    </form>

    @if ($epreuves->isEmpty())
        <p class="text-muted">Aucun document ne correspond à votre recherche.</p>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-3">
            @foreach ($epreuves as $doc)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <span class="badge {{ $doc->type == 'epreuve' ? 'badge-type-epreuve' : 'badge-type-corrige' }} mb-2">
                                {{ $doc->type == 'epreuve' ? 'Épreuve' : 'Corrigé' }}
                            </span>
                            <h5 class="card-title">{{ $doc->titre }}</h5>
                            <p class="card-text mb-1"><strong>Filière :</strong> {{ $doc->filiere }}</p>
                            <p class="card-text mb-1"><strong>Niveau :</strong> {{ $doc->niveau }}</p>
                            <p class="card-text mb-1"><strong>Matière :</strong> {{ $doc->matiere }}</p>
                            <p class="card-text mb-3"><strong>Année :</strong> {{ $doc->annee_academique }}</p>
                            <a href="{{ $doc->url_fichier }}" target="_blank" class="btn btn-outline-primary btn-sm w-100">Télécharger le PDF</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $epreuves->links() }}
        </div>
    @endif
@endsection
