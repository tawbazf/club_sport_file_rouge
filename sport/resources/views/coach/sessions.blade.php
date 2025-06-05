@extends('layouts.coach')
@section('title', 'Mes Séances')
@section('content')
<div>
    <h1>Mes Séances</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Membre</th>
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