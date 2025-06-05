@extends('layouts.app')
@section('title', 'Cours')
@section('content')
<div class="container">
    <h1>Nos Cours</h1>
    <div class="row">
        @foreach($courses as $course)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->title }}</h5>
                    <p class="card-text">{{ $course->description }}</p>
                    <p><strong>Coach:</strong> {{ $course->coach->user->name }}</p>
                    <p><strong>Horaire:</strong> {{ $course->start_time->format('d/m/Y H:i') }}</p>
                    <p><strong>Statut:</strong> {{ $course->status }}</p>
                    @auth
                    <form action="{{ route('reservations.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <input type="hidden" name="member_id" value="{{ auth()->user()->member->id }}">
                        <button type="submit" class="btn btn-primary">Réserver</button>
                    </form>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection