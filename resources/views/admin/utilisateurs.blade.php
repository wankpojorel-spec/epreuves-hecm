@extends('layouts.admin')

@section('titre', 'Gestion des utilisateurs')

@section('contenu')
    <h2 class="mb-3">Gestion des utilisateurs</h2>

    <form method="GET" class="mb-3">
        <input type="text" name="recherche" value="{{ request('recherche') }}" class="form-control" placeholder="Rechercher par nom ou email...">
    </form>

    <div class="table-responsive bg-white rounded shadow-sm">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Inscrit le</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($utilisateurs as $u)
                    <tr>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            <span class="badge {{ $u->role == 'admin' ? 'bg-dark' : 'bg-secondary' }}">
                                {{ $u->role }}
                            </span>
                        </td>
                        <td class="text-muted small">{{ $u->created_at->format('d/m/Y') }}</td>
                        <td class="text-end">
                            @if ($u->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.utilisateurs.role', $u) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-outline-primary">
                                        {{ $u->role == 'admin' ? 'Rétrograder' : 'Rendre admin' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.utilisateurs.supprimer', $u) }}" class="d-inline" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            @else
                                <span class="text-muted small">C'est vous</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-3">Aucun utilisateur trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $utilisateurs->links() }}</div>
@endsection
