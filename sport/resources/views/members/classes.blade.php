@extends('layouts.member')

@section('title', 'Réserver un Cours')

@section('content')
    <div class="container">
        <h1>Réserver un Cours</h1>
        <a href="{{ route('member.bookings') }}" class="btn btn-secondary mb-3">Voir mes réservations</a>
        <a href="{{ route('member.invoices') }}" class="btn btn-secondary mb-3">Voir mes factures</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($courses->isNotEmpty())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Coach</th>
                        <th>Date</th>
                        <th>Horaire</th>
                        <th>Places restantes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->coach->user->name }} ({{ $course->coach->specialty }})</td>
                            <td>{{ $course->start_time->format('d/m/Y') }}</td>
                            <td>{{ $course->start_time->format('H:i') }} - {{ $course->end_time->format('H:i') }}</td>
                            <td>{{ $course->capacity - $course->reservations->count() }}</td>
                            <td>
                                <form action="{{ route('member.reservations.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <button type="submit" class="btn btn-primary btn-sm">Réserver</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Aucun cours disponible pour réservation.</p>
        @endif
    </div>
@endsection