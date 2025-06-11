@extends('layouts.app')
@section('title', 'Nos Abonnements')
@section('content')

<!-- Hero Section -->
<div class="hero-section" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center; height: 50vh; display: flex; align-items: center; text-align: center; color: white;">
    <div class="container">
        <h1 class="display-4 font-weight-bold mb-4">Nos Abonnements</h1>
        <p class="lead mb-5">Choisissez la formule qui correspond à vos besoins sportifs</p>
    </div>
</div>

<div class="container py-5">
    <!-- Subscription Plans -->
    <div class="row">
        @foreach($subscriptionTypes as $subscription)
        <div class="col-lg-4 mb-4">
            <div class="card subscription-card h-100 border-0 shadow-lg">
                @if($subscription->type === 'premium')
                <div class="popular-tag bg-warning text-white text-center py-2">
                    Le plus populaire
                </div>
                @endif
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="my-0 text-capitalize">{{ $subscription->type }}</h3>
                    <div class="price mt-3">
                        <span class="h2">{{ $subscription->price }}€</span>
                        <span class="text-white-50">
                            @if($subscription->type === 'yearly')/an @else/mois @endif
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-4">
                        <li class="mb-3"><i class="fas fa-check-circle text-success mr-2"></i> Accès illimité à la salle</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success mr-2"></i> 
                            @if($subscription->type === 'premium')
                                Cours illimités
                            @else
                                10 cours/mois inclus
                            @endif
                        </li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success mr-2"></i> 
                            @if($subscription->type === 'premium')
                                4 séances coaching/mois
                            @elseif($subscription->type === 'yearly')
                                2 séances coaching/mois
                            @else
                                1 séance coaching/mois
                            @endif
                        </li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success mr-2"></i> 
                            {{ $subscription->type === 'premium' ? 'Accès sauna inclus' : 'Sauna en option' }}
                        </li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success mr-2"></i> 
                            {{ $subscription->type === 'premium' ? 'Service linge inclus' : 'Service linge en option' }}
                        </li>
                    </ul>
                </div>
                <div class="card-footer bg-white border-0 text-center pb-4">
                    <a href="{{ route('register') }}?subscription={{ $subscription->type }}" class="btn btn-primary btn-lg px-5">S'inscrire</a>
                    <p class="text-muted small mt-3 mb-0">
                        @if($subscription->type === 'yearly')
                            Engagement 12 mois
                        @else
                            Sans engagement
                        @endif
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Comparison Table -->
    <div class="row mt-5">
        <div class="col-12">
            <h2 class="text-center mb-4">Comparatif des abonnements</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Caractéristiques</th>
                            @foreach($subscriptionTypes as $subscription)
                            <th class="text-center text-capitalize">{{ $subscription->type }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Accès à la salle</td>
                            @foreach($subscriptionTypes as $subscription)
                            <td class="text-center">Illimité</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Cours inclus</td>
                            @foreach($subscriptionTypes as $subscription)
                            <td class="text-center">
                                @if($subscription->type === 'premium')
                                    Illimités
                                @else
                                    10/mois
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Séances coaching</td>
                            @foreach($subscriptionTypes as $subscription)
                            <td class="text-center">
                                @if($subscription->type === 'premium')
                                    4/mois
                                @elseif($subscription->type === 'yearly')
                                    2/mois
                                @else
                                    1/mois
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Accès sauna</td>
                            @foreach($subscriptionTypes as $subscription)
                            <td class="text-center">{!! $subscription->type === 'premium' ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Service linge</td>
                            @foreach($subscriptionTypes as $subscription)
                            <td class="text-center">{!! $subscription->type === 'premium' ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Prix</td>
                            @foreach($subscriptionTypes as $subscription)
                            <td class="text-center font-weight-bold">
                                {{ $subscription->price }}€
                                <small class="text-muted d-block">
                                    @if($subscription->type === 'yearly')par an @else par mois @endif
                                </small>
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="row mt-5">
        <div class="col-12">
            <h2 class="text-center mb-4">Questions fréquentes</h2>
            <div class="accordion" id="faqAccordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Puis-je changer d'abonnement ?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqAccordion">
                        <div class="card-body">
                            Oui, vous pouvez changer d'abonnement à tout moment. La modification prendra effet à la fin de votre période de facturation en cours.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Y a-t-il des frais d'inscription ?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                        <div class="card-body">
                            Non, nous n'appliquons pas de frais d'inscription. Vous payez uniquement votre abonnement mensuel ou annuel.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Comment résilier mon abonnement ?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
                        <div class="card-body">
                            Vous pouvez résilier votre abonnement à tout moment via votre espace membre, avec un préavis de 30 jours. Les abonnements annuels peuvent être résiliés après la première année.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="row mt-5">
        <div class="col-12 text-center">
            <h3 class="mb-4">Vous avez des questions sur nos abonnements ?</h3>
            <a href="{{ route('public.contact.form') }}" class="btn btn-primary btn-lg mr-3">Nous contacter</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">S'inscrire maintenant</a>
        </div>
    </div>
</div>

<style>
    .subscription-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
    }
    .subscription-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    .popular-tag {
        position: absolute;
        top: 0;
        right: 20px;
        transform: translateY(-50%);
        border-radius: 20px;
        padding: 5px 15px;
        font-size: 14px;
        font-weight: bold;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        z-index: 1;
    }
    .card-header {
        border-radius: 0 !important;
    }
    .price {
        background: rgba(255,255,255,0.2);
        display: inline-block;
        padding: 5px 20px;
        border-radius: 30px;
    }
    .accordion .card-header {
        background-color: #f8f9fa;
        cursor: pointer;
    }
    .accordion .btn-link {
        color: #4e73df;
        text-decoration: none;
        width: 100%;
        text-align: left;
    }
</style>

@endsection