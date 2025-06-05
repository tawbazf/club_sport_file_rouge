@extends('layouts.admin')
@section('title', 'Gestion des Membres')
@section('content')
<div>
    <h1>Gestion des Membres</h1>
    <a href="{{ route('members.create') }}" class="btn btn-primary mb-3">Ajouter un Membre</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{ $member->user->name }}</td>
                <td>{{ $member->user->email }}</td>
                <td>{{ $member->phone }}</td>
                <td>{{ $member->status }}</td>
                <td>
                    <a href="{{ route('members.show', $member) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('members.edit', $member) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('members.destroy', $member) }}" method="POST" style="display:inline;">
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