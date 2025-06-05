<nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            @if(auth()->user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('members.index') }}">Membres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('coaches.index') }}">Coachs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('courses.index') }}">Cours</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('invoices.index') }}">Factures</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('attendances.index') }}">Rapports</a>
            </li>
            @elseif(auth()->user()->role === 'coach')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('coach.sessions') }}">Mes Séances</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('coach.schedule') }}">Mon Planning</a>
            </li>
            @elseif(auth()->user()->role === 'member')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('member.classes') }}">Mes Cours</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('member.bookings') }}">Mes Réservations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('member.invoices') }}">Mes Factures</a>
            </li>
            @endif
        </ul>
    </div>
</nav>