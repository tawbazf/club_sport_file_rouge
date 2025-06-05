@extends('layouts.member')
@section('title', 'Mes Factures')
@section('content')
<div>
    <h1>Mes Factures</h1>
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
                <td>{{ $invoice->status }}</td>
                <td>{{ $invoice->details }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection