@extends('layouts.app')
@section('title', 'Nos Coachs')
@section('content')
<div class="container">
    <h1>Nos Coachs</h1>
    <div class="row">
        @foreach($coaches as $coach)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $coach->user->name }}</h5>
                    <p class="card-text"><strong>Spécialité:</strong> {{ $coach->specialty }}</p>
                    <p class="card-text">{{ $coach->bio }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection