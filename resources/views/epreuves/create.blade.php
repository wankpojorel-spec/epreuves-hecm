@extends('layouts.app')

@section('titre', 'Déposer un document')

@section('contenu')
    <h2 class="mb-3">Déposer une épreuve ou un corrigé</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erreur)
                    <li>{{ $erreur }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('epreuves.store') }}" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Titre du document</label>
            <input type="text" name="titre" value="{{ old('titre') }}" class="form-control" placeholder="Ex: Examen final Algorithmique S2" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Filière</label>
                <input type="text" name="filiere" value="{{ old('filiere') }}" class="form-control" placeholder="Ex: Licence Informatique" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Niveau</label>
                <select name="niveau" class="form-select" required>
                    <option value="">-- Choisir --</option>
                    <option value="L1">L1</option>
                    <option value="L2">L2</option>
                    <option value="L3">L3</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Matière</label>
                <input type="text" name="matiere" value="{{ old('matiere') }}" class="form-control" placeholder="Ex: Réseaux" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Année académique</label>
                <input type="text" name="annee_academique" value="{{ old('annee_academique') }}" class="form-control" placeholder="Ex: 2023-2024" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Type de document</label>
            <select name="type" class="form-select" required>
                <option value="epreuve">Épreuve</option>
                <option value="corrige">Corrigé</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Fichier PDF (max 10 Mo)</label>
            <input type="file" name="fichier" accept="application/pdf" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Publier</button>
    </form>
@endsection
