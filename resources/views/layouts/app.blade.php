<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titre', 'Épreuves & Corrigés - HECM Bohicon')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f7fa; display: flex; flex-direction: column; min-height: 100vh; }
        main { flex: 1; }
        .navbar-brand { font-weight: 600; }
        .card { transition: transform .15s ease; }
        .card:hover { transform: translateY(-3px); box-shadow: 0 6px 14px rgba(0,0,0,.08); }
        .badge-type-epreuve { background-color: #0d6efd; }
        .badge-type-corrige { background-color: #198754; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">📚 Épreuves & Corrigés</a>
            <div class="d-flex align-items-center gap-2">
                @auth
                    <a href="{{ route('epreuves.index') }}" class="btn btn-outline-light btn-sm">Rechercher</a>
                    <a href="{{ route('epreuves.create') }}" class="btn btn-primary btn-sm">+ Déposer un document</a>
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm">⚙️ Admin</a>
                    @endif
                    <span class="text-light small ms-2 me-1">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Connexion</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Inscription</a>
                @endauth
            </div>
        </div>
    </nav>
    <main>
        <div class="container">
            @if (session('succes'))
                <div class="alert alert-success">{{ session('succes') }}</div>
            @endif
            @yield('contenu')
        </div>
    </main>
    @include('partials.footer')
</body>
</html>