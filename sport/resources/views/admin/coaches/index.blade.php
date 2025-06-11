@extends('layouts.admin')
@section('title', 'Gestion des Coachs')
@section('content')
<div>
    <h1>Gestion des Coachs</h1>
    <a href="{{ route('admin.coaches.create') }}" class="btn btn-primary mb-3">Ajouter un Coach</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Spécialité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coaches as $coach)
            <tr>
                <td>{{ $coach->user->name }}</td>
                <td>{{ $coach->specialty }}</td>
                <td>
                    <a href="{{ route('admin.coaches.show', $coach) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('admin.coaches.edit', $coach) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('admin.coaches.destroy', $coach) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection