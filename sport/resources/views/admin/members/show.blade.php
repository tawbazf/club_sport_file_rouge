@extends('layouts.admin')
@section('title', 'Détails du Membre')
@section('content')
<div>
    <h1>Détails du Membre</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $member->user->name }}</h5>
            <p><strong>Email:</strong> {{ $member->user->email }}</p>
            <p><strong>Téléphone:</strong> {{ $member->phone }}</p>
            <p><strong>Adresse:</strong> {{ $member->address }}</p>
            <p><strong>Date de naissance:</strong> {{ $member->birth_date ? $member->birth_date->format('d/m/Y') : 'N/A' }}</p>
            <p><strong>Statut:</strong> {{ $member->status }}</p>
            <a href="{{ route('members.edit', $member) }}" class="btn btn-warning">Modifier</a>
            <form action="{{ route('members.destroy', $member) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection