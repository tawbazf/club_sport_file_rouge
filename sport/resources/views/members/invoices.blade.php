@extends('layouts.member')

@section('title', 'Mes Factures')

@section('content')
    <div class="container">
        <h1>Mes Factures</h1>
        <a href="{{ route('member.classes') }}" class="btn btn-secondary mb-3">Réserver un cours</a>
        <a href="{{ route('member.bookings') }}" class="btn btn-secondary mb-3">Voir mes réservations</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($invoices->isNotEmpty())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Montant</th>
                        <th>Date d'émission</th>
                        <th>Statut</th>
                        <th>Détails</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->amount }} €</td>
                            <td>{{ $invoice->issue_date->format('d/m/Y') }}</td>
                            <td>{{ ucfirst($invoice->status) }}</td>
                            <td>{{ $invoice->details ?? 'Aucun détail' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Aucune facture disponible.</p>
        @endif
    </div>
@endsection