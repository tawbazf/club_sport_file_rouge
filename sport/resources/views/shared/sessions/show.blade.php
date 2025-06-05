@extends('layouts.app')
@section('title', 'Détails de la Séance')
@section('content')
<div class="container">
    <h1>Détails de la Séance</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Membre:</strong> {{ $session->member->user->name }}</p>
            <p><strong>Coach:</strong> {{ $session->coach->user->name }}</p>
            <p><strong>Date:</strong> {{ $session->start_time->format('d/m/Y') }}</p>
            <p><strong>Horaire:</strong> {{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</p>
            <p><strong>Durée:</strong> {{ $session->duration }} min</p>
            <p><strong>Statut:</strong> {{ $session->status }}</p>
        </div>
    </div>
</div>
@endsection