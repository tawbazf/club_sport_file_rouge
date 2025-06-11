@extends('layouts.member')

@section('title', 'Mes Réservations')

@section('content')
    <div class="container">
        <h1>Mes Réservations</h1>
        <a href="{{ route('member.classes') }}" class="btn btn-secondary mb-3">Réserver un cours</a>
        <a href="{{ route('member.invoices') }}" class="btn btn-secondary mb-3">Voir mes factures</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($reservations->isNotEmpty())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cours</th>
                        <th>Coach</th>
                        <th>Date</th>
                        <th>Horaire</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->course->title }}</td>
                            <td>{{ $reservation->course->coach->user->name }}</td>
                            <td>{{ $reservation->course->start_time->format('d/m/Y') }}</td>
                            <td>{{ $reservation->course->start_time->format('H:i') }} - {{ $reservation->course->end_time->format('H:i') }}</td>
                            <td>{{ ucfirst($reservation->status) }}</td>
                            <td>
                                <form action="{{ route('member.reservations.destroy', $reservation) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="deregister($event)">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Aucune réservation.</p>
        @endif
    </div>
@endsection