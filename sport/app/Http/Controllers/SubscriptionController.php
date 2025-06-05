<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with('member.user')->get();
        return response()->json($subscriptions);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'type' => 'required|in:monthly,yearly,premium',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,expired',
        ]);

        $subscription = Subscription::create($data);
        return response()->json(['message' => 'Abonnement créé', 'subscription' => $subscription], 201);
    }

    public function show(Subscription $subscription)
    {
        $subscription->load('member.user', 'invoices');
        return response()->json($subscription);
    }

    public function update(Request $request, Subscription $subscription)
    {
        $data = $request->validate([
            'type' => 'required|in:monthly,yearly,premium',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,expired',
        ]);

        $subscription->update($data);
        return response()->json(['message' => 'Abonnement mis à jour', 'subscription' => $subscription]);
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return response()->json(['message' => 'Abonnement supprimé']);
    }
}