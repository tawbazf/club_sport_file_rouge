<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('public.home') }}">Club de Sport</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('public.classes') }}">Cours</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('public.coaches') }}">Coachs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('public.schedule') }}">Planning</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('public.contact') }}">Contact</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route(auth()->user()->role . '.dashboard') }}">Tableau de bord</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link">Déconnexion</button>
                    </form>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>