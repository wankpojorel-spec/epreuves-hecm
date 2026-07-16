<footer class="bg-dark text-light pt-5 pb-4 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5 class="mb-3">📚 Épreuves HECM</h5>
                <p class="text-secondary small mb-0">
                    Plateforme collaborative de partage d'épreuves et de corrigés pour les étudiants
                     .Un projet étudiant pour faciliter la révision et la réussite de tous.
                </p>
            </div>
            <div class="col-md-4">
                <h6 class="mb-3">Liens rapides</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ url('/') }}" class="text-secondary text-decoration-none">Accueil</a></li>
                    @auth
                        <li class="mb-2"><a href="{{ route('epreuves.index') }}" class="text-secondary text-decoration-none">Rechercher une épreuve</a></li>
                        <li class="mb-2"><a href="{{ route('epreuves.create') }}" class="text-secondary text-decoration-none">Déposer un document</a></li>
                    @else
                        <li class="mb-2"><a href="{{ route('login') }}" class="text-secondary text-decoration-none">Connexion</a></li>
                        <li class="mb-2"><a href="{{ route('register') }}" class="text-secondary text-decoration-none">Inscription</a></li>
                    @endauth
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="mb-3">Contact</h6>
                <p class="text-secondary small mb-1">HECM Bohicon — Licence Informatique</p>
                <p class="text-secondary small mb-1">Email : <a class="text-secondary text-decoration-underline" href="mailto:TON_EMAIL">wankpojore@gmail.com</a></p>
                <p class="text-secondary small mb-1">WhatsApp : <a class="text-secondary text-decoration-underline" href="https://wa.me/TON_NUMERO">+ 229 0168038731</a></p>
                <span class="badge bg-primary-subtle text-primary-emphasis mt-2">Version gratuite — offres premium bientôt disponibles</span>
            </div>
        </div>
        <hr class="border-secondary mt-4 mb-3">
        <p class="text-secondary small text-center mb-0">
            &copy; {{ date('Y') }} Épreuves HECM. Tous droits réservés.
        </p>
    </div>
</footer>
