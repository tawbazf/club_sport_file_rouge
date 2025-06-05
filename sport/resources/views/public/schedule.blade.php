@extends('layouts.app')
@section('title', 'Planning')
@section('content')
<div class="container">
    <h1>Planning des Cours</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Cours</th>
                <th>Coach</th>
                <th>Date</th>
                <th>Horaire</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->title }}</td>
                <td>{{ $course->coach->user->name }}</td>
                <td>{{ $course->start_time->format('d/m/Y') }}</td>
                <td>{{ $course->start_time->format('H:i') }} - {{ $course->end_time->format('H:i') }}</td>
                <td>{{ $course->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection