@extends('layouts.app')
@section('title', 'Accueil')
@section('content')
<div class="container">
    <h1>Bienvenue au Club de Sport</h1>
    <p>Découvrez nos services, abonnements, et cours collectifs. Rejoignez-nous pour une expérience sportive unique !</p>
    <a href="{{ route('public.classes') }}" class="btn btn-primary">Voir les cours</a>
    <a href="{{ route('public.coaches') }}" class="btn btn-secondary">Nos coachs</a>
    <a href="{{ route('public.schedule') }}" class="btn btn-info">Planning</a>
    <a href="{{ route('public.contact') }}" class="btn btn-success">Contactez-nous</a>
</div>
@endsection