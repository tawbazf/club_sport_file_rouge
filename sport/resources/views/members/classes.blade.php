@extends('layouts.member')
@section('title', 'Mes Cours')
@section('content')
<div>
    <h1>Mes Cours</h1>
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
                <td>{{ $reservation->status }}</td>
                <td>
                    <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Annuler la réservation ?')">Annuler</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection