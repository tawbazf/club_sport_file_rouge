@extends('layouts.app')

@section('title', 'Modifier un Cours')

@section('content')
    <div class="container">
        <h1>Modifier un Cours</h1>
        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary mb-3">Retour</a>

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

        <form action="{{ route('admin.courses.update', $course) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $course->title) }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $course->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="coach_id" class="form-label">Coach</label>
                <select name="coach_id" id="coach_id" class="form-control @error('coach_id') is-invalid @enderror">
                    <option value="">Sélectionner un coach</option>
                    @foreach($coaches as $coach)
                        <option value="{{ $coach->id }}" {{ old('coach_id', $course->coach_id) == $coach->id ? 'selected' : '' }}>{{ $coach->user->name }} ({{ $coach->specialty }})</option>
                    @endforeach
                </select>
                @error('coach_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Heure de début</label>
                <input type="datetime-local" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time', $course->start_time->format('Y-m-d\TH:i')) }}">
                @error('start_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">Heure de fin</label>
                <input type="datetime-local" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time', $course->end_time->format('Y-m-d\TH:i')) }}">
                @error('end_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="capacity" class="form-label">Capacité</label>
                <input type="number" name="capacity" id="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ old('capacity', $course->capacity) }}" min="1">
                @error('capacity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Statut</label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="planned" {{ old('status', $course->status) == 'planned' ? 'selected' : '' }}>Planifié</option>
                    <option value="cancelled" {{ old('status', $course->status) == 'cancelled' ? 'selected' : '' }}>Annulé</option>
                    <option value="completed" {{ old('status', $course->status) == 'completed' ? 'selected' : '' }}>Terminé</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
