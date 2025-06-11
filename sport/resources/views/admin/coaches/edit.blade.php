@extends('layouts.app')

@section('title', 'Modifier un Coach')

@section('content')
    <div class="container">
        <h1>Modifier un Coach</h1>
        <a href="{{ route('admin.coaches.index') }}" class="btn btn-secondary mb-3">Retour</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.coaches.update', $coach) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="user_id" class="form-label">Utilisateur</label>
                <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                    <option value="">Sélectionner un utilisateur</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $coach->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="specialty" class="form-label">Spécialité</label>
                <input type="text" name="specialty" id="Spécialité" class="form-control @error('specialty') is-invalid @enderror" value="{{ $specialty ?? old('specialty') }}">

                <input type="text" name="specialty" id="specialty" class="form-control @error('specialty') is-invalid @enderror" value="{{ old('specialty', $coach->specialty) }}">
                @error('specialty')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label">Biographie</label>
                <textarea name="bio" id="bio" class="form-control @error('bio') is-invalid @enderror">{{ old('bio', $coach->bio) }}</textarea>
                @error('bio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
