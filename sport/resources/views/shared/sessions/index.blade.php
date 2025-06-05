@extends('layouts.app')
@section('title', 'Séances')
@section('content')
<div class="container">
    <h1>Liste des Séances</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Membre</th>
                <th>Coach</th>
                <th>Date</th>
                <th>Horaire</th>
                <th>Durée</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sessions as $session)
            <tr>
                <td>{{ $session->member->user->name }}</td>
                <td>{{ $session->coach->user->name }}</td>
                <td>{{ $session->start_time->format('d/m/Y') }}</td>
                <td>{{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</td>
                <td>{{ $session->duration }} min</td>
                <td>{{ $session->status }}</td>
                <td>
                    <a href="{{ route('sessions.show', $session) }}" class="btn btn-info btn-sm">Voir</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection