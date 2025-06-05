@extends('layouts.coach')
@section('title', 'Mon Planning')
@section('content')
<div>
    <h1>Mon Planning</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Type</th>
                <th>Titre/Membre</th>
                <th>Date</th>
                <th>Horaire</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>Cours</td>
                <td>{{ $course->title }}</td>
                <td>{{ $course->start_time->format('d/m/Y') }}</td>
                <td>{{ $course->start_time->format('H:i') }} - {{ $course->end_time->format('H:i') }}</td>
                <td>{{ $course->status }}</td>
            </tr>
            @endforeach
            @foreach($sessions as $session)
            <tr>
                <td>Séance</td>
                <td>{{ $session->member->user->name }}</td>
                <td>{{ $session->start_time->format('d/m/Y') }}</td>
                <td>{{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</td>
                <td>{{ $session->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection