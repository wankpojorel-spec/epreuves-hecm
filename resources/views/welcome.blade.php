<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Épreuves & Corrigés - HECM Bohicon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', sans-serif; }
        .hero {
            background: linear-gradient(135deg, #0d47a1 0%, #1565c0 50%, #1976d2 100%);
            color: white;
            padding: 100px 0 120px;
        }
        .hero h1 { font-weight: 700; font-size: 2.8rem; }
        .feature-icon {
            width: 56px; height: 56px;
            display: flex; align-items: center; justify-content: center;
            background: #e3f2fd; border-radius: 12px;
            font-size: 1.6rem; margin-bottom: 1rem;
        }
        .card-feature { border: none; border-radius: 16px; box-shadow: 0 4px 16px rgba(0,0,0,.06); height: 100%; }
        .btn-hero { padding: 12px 28px; font-weight: 600; border-radius: 8px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark" style="background: transparent; position: absolute; width: 100%; z-index: 10;">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">📚 Épreuves HECM</a>
            <div class="d-flex gap-2">
                @auth
                    <a href="{{ route('epreuves.index') }}" class="btn btn-light btn-sm">Mon espace</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Connexion</a>
                    <a href="{{ route('register') }}" class="btn btn-light btn-sm">Inscription</a>
                @endauth
            </div>
        </div>
    </nav>

    <section class="hero text-center">
        <div class="container">
            <h1 class="mb-3">Toutes les épreuves et corrigés des années antérieures</h1>
            <p class="lead mb-4">Une plateforme collaborative pour les étudiants de HECM Bohicon : consultez, téléchargez et partagez les épreuves avant vos compositions.</p>
            @guest
                <a href="{{ route('register') }}" class="btn btn-light btn-hero me-2">Créer un compte gratuit</a>
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-hero">Se connecter</a>
            @else
                <a href="{{ route('epreuves.index') }}" class="btn btn-light btn-hero">Accéder aux épreuves</a>
            @endguest
        </div>
    </section>

    <section class="py-5" style="margin-top: -60px;">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card card-feature p-4">
                        <div class="feature-icon">🔍</div>
                        <h5>Recherche rapide</h5>
                        <p class="text-muted mb-0">Filtrez par filière, niveau, matière ou année académique pour trouver exactement ce qu'il vous faut.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-feature p-4">
                        <div class="feature-icon">📤</div>
                        <h5>Partage collaboratif</h5>
                        <p class="text-muted mb-0">Chaque étudiant ou enseignant inscrit peut déposer une épreuve ou un corrigé pour aider les autres.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-feature p-4">
                        <div class="feature-icon">🔒</div>
                        <h5>Espace sécurisé</h5>
                        <p class="text-muted mb-0">Un compte gratuit est nécessaire pour garantir la qualité et la fiabilité des contenus partagés.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

</body>
</html>
