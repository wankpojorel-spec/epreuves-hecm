<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titre', 'Admin') - Épreuves HECM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f7fa; }
        .sidebar {
            min-height: 100vh; background: #1a1d29; color: #fff; width: 220px;
        }
        .sidebar a {
            color: #adb5bd; text-decoration: none; display: block; padding: 10px 20px;
        }
        .sidebar a:hover, .sidebar a.active { background: #2b2f42; color: #fff; }
        .wrapper { display: flex; }
        .content { flex: 1; padding: 30px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="sidebar py-3">
            <h5 class="px-3 mb-4">⚙️ Admin</h5>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">📊 Tableau de bord</a>
            <a href="{{ route('admin.documents') }}" class="{{ request()->routeIs('admin.documents') ? 'active' : '' }}">📄 Documents</a>
            <a href="{{ route('admin.utilisateurs') }}" class="{{ request()->routeIs('admin.utilisateurs') ? 'active' : '' }}">👥 Utilisateurs</a>
            <hr class="border-secondary">
            <a href="{{ route('epreuves.index') }}">🔙 Retour au site</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link" style="color: #adb5bd; padding: 10px 20px;">🚪 Déconnexion</button>
            </form>
        </div>

        <div class="content">
            @if (session('succes'))
                <div class="alert alert-success">{{ session('succes') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            @yield('contenu')
        </div>
    </div>
</body>
</html>
