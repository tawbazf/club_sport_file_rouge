<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('member.user', 'subscription', 'session')->get();
        return response()->json($invoices);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'subscription_id' => 'nullable|exists:subscriptions,id',
            'session_id' => 'nullable|exists:sessions,id',
            'amount' => 'required|numeric|min:0',
            'details' => 'nullable|string',
            'issue_date' => 'required|date',
            'status' => 'required|in:paid,pending,cancelled',
        ]);

        $invoice = Invoice::create($data);
        return response()->json(['message' => 'Facture créée', 'invoice' => $invoice], 201);
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('member.user', 'subscription', 'session');
        return response()->json($invoice);
    }

    public function update(Request $request, Invoice $invoice)
    {
        $data = $request->validate([
            'amount' => 'required|numeric|min:0',
            'details' => 'nullable|string',
            'issue_date' => 'required|date',
            'status' => 'required|in:paid,pending,cancelled',
        ]);

        $invoice->update($data);
        return response()->json(['message' => 'Facture mise à jour', 'invoice' => $invoice]);
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return response()->json(['message' => 'Facture supprimée']);
    }
}