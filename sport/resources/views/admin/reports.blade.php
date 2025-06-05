@extends('layouts.admin')
@section('title', 'Rapports')
@section('content')
<div>
    <h1>Rapports de Fréquentation</h1>
    <form method="GET" action="{{ route('attendances.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Date de début</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">Date de fin</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary mt-4">Filtrer</button>
            </div>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Membre</th>
                <th>Cours/Séance</th>
                <th>Statut</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr>
                <td>{{ $attendance->member->user->name }}</td>
                <td>{{ $attendance->course ? $attendance->course->title : ($attendance->session ? 'Séance' : 'N/A') }}</td>
                <td>{{ $attendance->status }}</td>
                <td>{{ $attendance->attendance_date->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection