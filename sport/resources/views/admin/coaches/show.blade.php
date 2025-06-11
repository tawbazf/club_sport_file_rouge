
@extends('layouts.app')

@section('title', 'Détails du Coach')

@section('content')
    <div class="container">
        <h1>Détails du Coach</h1>
        <a href="{{ route('admin.coaches.index') }}" class="btn btn-secondary mb-3">Retour</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $coach->user->name }}</h5>
                <p><strong>Email :</strong> {{ $coach->user->email }}</p>
                <p><strong>Spécialité :</strong> {{ $coach->specialty }}</p>
                <p><strong>Biographie :</strong> {{ $coach->bio ?? 'Aucune biographie' }}</p>

                <h6>Cours</h6>
                @if($coach->courses->isNotEmpty())
                    <ul>
                        @foreach($coach->courses as $course)
                            <li>{{ $course->title }} ({{ $course->start_time->format('d/m/Y H:i') }})</li>
                        @endforeach
                    </ul>
                @else
                    <p>Aucun cours assigné.</p>
                @endif

                <h6>Sessions</h6>
                @if($coach->sessions->isNotEmpty())
                    <ul>
                        @foreach($coach->sessions as $session)
                            <li>{{ $session->course->title }} ({{ $session->date->format('d/m/Y H:i') }})</li>
                        @endforeach
                    </ul>
                @else
                    <p>Aucune session disponible.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
