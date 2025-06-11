@extends('layouts.app')
@section('title', 'Accueil')
@section('content')

<!-- Hero Section -->
<div class="hero-section" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center; height: 60vh; display: flex; align-items: center; text-align: center; color: white;">
    <div class="container">
        <h1 class="display-4 font-weight-bold mb-4">Bienvenue au Club de Sport</h1>
        <p class="lead mb-5">Découvrez nos services premium, abonnements flexibles, et cours collectifs animés par des professionnels.</p>
        <a href="{{ route('public.subscriptions') }}" class="btn btn-primary btn-lg mr-3">Nos Abonnements</a>
        <a href="{{ route('public.contact') }}" class="btn btn-outline-light btn-lg">Essai Gratuit</a>
    </div>
</div>

<div class="container py-5">
    <!-- Features Section -->
    <div class="row text-center mb-5">
        <div class="col-md-4 mb-4">
            <div class="feature-box p-4 rounded-lg shadow-sm">
                <img src="https://cdn-icons-png.flaticon.com/512/2936/2936886.png" alt="Workout" class="img-fluid mb-3" style="height: 80px;">
                <h3>Équipements Modernes</h3>
                <p class="text-muted">Matériel haut de gamme pour des résultats optimaux</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="feature-box p-4 rounded-lg shadow-sm">
                <img src="https://cdn-icons-png.flaticon.com/512/2103/2103633.png" alt="Coach" class="img-fluid mb-3" style="height: 80px;">
                <h3>Coach Experts</h3>
                <p class="text-muted">Accompagnement personnalisé par des professionnels</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="feature-box p-4 rounded-lg shadow-sm">
                <img src="https://cdn-icons-png.flaticon.com/512/1570/1570887.png" alt="Schedule" class="img-fluid mb-3" style="height: 80px;">
                <h3>Flexibilité</h3>
                <p class="text-muted">Horaires adaptés à votre emploi du temps</p>
            </div>
        </div>
    </div>

    <!-- Subscriptions Section -->
    @if($subscriptions->isNotEmpty())
    <section id="subscriptions" class="mb-5 py-4 bg-light rounded-lg">
        <div class="container">
            <h2 class="text-center mb-5">Nos Abonnements</h2>
            <div class="row">
                @foreach($subscriptions as $subscription)
                <div class="col-md-4 mb-4">
                    <div class="card subscription-card h-100 border-0 shadow-sm">
                        <div class="card-header bg-primary text-white text-center py-3">
                            <h4 class="my-0">{{ $subscription->type }}</h4>
                        </div>
                        <div class="card-body text-center">
                            <h2 class="card-title pricing-card-title">{{ $subscription->price }} €<small class="text-muted">/mois</small></h2>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Accès illimité au club</li>
                                <li>{{ $subscription->type === 'Premium' ? 'Cours illimités' : '5 cours/mois' }}</li>
                                <li>Suivi personnalisé</li>
                                <li>{{ $subscription->type === 'Premium' ? 'Sauna inclus' : '' }}</li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-block btn-outline-primary">S'abonner</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Coaches Section -->
    @if($coaches->isNotEmpty())
    <section class="mb-5 py-4">
        <h2 class="text-center mb-5">Nos Coachs Experts</h2>
        <div class="row">
            @foreach($coaches as $coach)
            <div class="col-md-4 mb-4">
                <div class="card coach-card h-100 border-0 shadow-sm overflow-hidden">
                    <img src="https://randomuser.me/api/portraits/{{ $coach->user->gender === 'female' ? 'women' : 'men' }}/{{ $loop->index + 10 }}.jpg" class="card-img-top" alt="{{ $coach->user->name }}" style="height: 250px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-1">{{ $coach->user->name }}</h5>
                        <span class="badge badge-pill badge-primary mb-3">{{ $coach->specialty }}</span>
                        <p class="card-text text-muted small">"Votre succès est ma motivation quotidienne."</p>
                        <div class="social-icons">
                            <a href="#" class="text-dark mx-2"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-dark mx-2"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('public.coaches') }}" class="btn btn-outline-primary">Voir tous nos coachs</a>
        </div>
    </section>
    @endif

    <!-- Courses Section -->
    @if($courses->isNotEmpty())
    <section class="mb-5 py-4 bg-light rounded-lg">
        <h2 class="text-center mb-5">Nos Cours Populaires</h2>
        <div class="row">
            @foreach($courses as $course)
            <div class="col-md-4 mb-4">
                <div class="card course-card h-100 border-0 shadow-sm overflow-hidden">
                    <div class="position-relative">
                        <!-- Dynamic course images based on course type -->
                        @php
                            $courseImages = [
                                'Yoga' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                                'Crossfit' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                                'Pilates' => 'https://images.unsplash.com/photo-1571902943202-507ec2618e8f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                                'Zumba' => 'https://images.unsplash.com/photo-1547153760-18fc86324498?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
                            ];
                            $courseImage = $courseImages[$course->title] ?? 'https://images.unsplash.com/photo-1538805060514-97d9cc17730c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60';
                        @endphp
                        <img src="{{ $courseImage }}" class="card-img-top" alt="{{ $course->title }}" style="height: 200px; object-fit: cover;">
                        <span class="badge badge-success position-absolute" style="top: 10px; right: 10px;">Nouveau</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($course->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><i class="far fa-user mr-1"></i> {{ $course->coach->user->name }}</small>
                            <small class="text-primary"><i class="far fa-clock mr-1"></i> {{ $course->start_time->format('d/m H:i') }}</small>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="#" class="btn btn-sm btn-block btn-primary">Réserver</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('public.classes') }}" class="btn btn-outline-primary">Voir tous les cours</a>
            <a href="{{ route('public.schedule') }}" class="btn btn-outline-info ml-2">Voir le planning</a>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <div class="row align-items-center bg-primary text-white rounded-lg p-5 mb-5">
        <div class="col-md-8">
            <h3 class="mb-3">Prêt à transformer votre vie ?</h3>
            <p class="mb-0">Rejoignez notre communauté sportive dès aujourd'hui et bénéficiez d'une séance d'essai gratuite !</p>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{ route('public.contact') }}" class="btn btn-light btn-lg">Nous Contacter</a>
        </div>
    </div>
</div>

<style>
    .feature-box {
        transition: transform 0.3s ease;
    }
    .feature-box:hover {
        transform: translateY(-10px);
    }
    .subscription-card:hover {
        transform: scale(1.03);
        transition: transform 0.3s ease;
    }
    .coach-card:hover {
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .course-card:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .badge-primary {
        background-color: #4e73df;
    }
    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
    }
</style>

@endsection