
@extends('layouts.app')

@section('title', 'Détails du Cours')

@section('content')
    <div class="container">
        <h1>Détails du Cours</h1>
        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary mb-3">Retour</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $course->title }}</h5>
                <p><strong>Description :</strong> {{ $course->description ?? 'Aucune description' }}</p>
                <p><strong>Coach :</strong> {{ $course->coach->user->name }} ({{ $course->coach->specialty }})</p>
                <p><strong>Début :</strong> {{ $course->start_time->format('d/m/Y H:i') }}</p>
                <p><strong>Fin :</strong> {{ $course->end_time->format('d/m/Y H:i') }}</p>
                <p><strong>Capacité :</strong> {{ $course->capacity }}</p>
                <p><strong>Statut :</strong> {{ ucfirst($course->status) }}</p>

                <h6>Réservations</h6>
                @if($course->reservations->isNotEmpty())
                    <ul>
                        @foreach($course->reservations as $reservation)
                            <li>{{ $reservation->member->user->name }} ({{ $reservation->member->user->email }})</li>
                        @endforeach
                    </ul>
                @else
                    <p>Aucune réservation.</p>
                @endif

                <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-primary">Modifier</a>
                <form action="{{ route('admin.courses.checkAndCancel', $course) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-warning" onclick="return confirm('Vérifier et annuler ce cours ?')">Vérifier et Annuler</button>
                </form>
                <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer ce cours ?')">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
@endsection