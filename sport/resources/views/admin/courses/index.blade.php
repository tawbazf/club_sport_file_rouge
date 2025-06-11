
@extends('layouts.app')

@section('title', 'Liste des Cours')

@section('content')
    <div class="container">
        <h1>Liste des Cours</h1>
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary mb-3">Créer un Cours</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        @if($courses->isNotEmpty())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Coach</th>
                        <th>Début</th>
                        <th>Statut</th>
                        <th>Réservations</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->coach->user->name }} ({{ $course->coach->specialty }})</td>
                            <td>{{ $course->start_time->format('d/m/Y H:i') }}</td>
                            <td>{{ ucfirst($course->status) }}</td>
                            <td>{{ $course->reservations->count() }}</td>
                            <td>
                                <a href="{{ route('admin.courses.show', $course) }}" class="btn btn-info btn-sm">Voir</a>
                                <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('admin.courses.checkAndCancel', $course) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Vérifier et annuler ce cours ?')">Annuler si < 3</button>
                                </form>
                                <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce cours ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Aucun cours disponible.</p>
        @endif
    </div>
@endsection
