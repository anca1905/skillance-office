<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $transactions = Transaction::orderBy('transaction_date', 'desc')->get();

        $pemasukan = Transaction::where('type', 'income')->sum('amount');
        $pengeluaran = Transaction::where('type', 'expense')->sum('amount');

        $modalAwal = 10000000;
        $saldo = $modalAwal + $pemasukan - $pengeluaran;
        
        $invoicesUnpaid = \App\Models\Invoice::with('items')->where('status', 'UNPAID')->get();
        $totalPiutang = $invoicesUnpaid->reduce(function ($carry, $inv) {
            return $carry + $inv->items->sum('total');
        }, 0);

        return view('finance.index', compact('transactions', 'pemasukan', 'pengeluaran', 'saldo', 'totalPiutang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_date' => 'required|date',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:1000',
            'description' => 'required|string|max:255',
            'category' => 'nullable|string|max:100'
        ]);

        Transaction::create([
            'transaction_date' => $request->transaction_date,
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
            'category' => $request->category,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Transaksi berhasil dicatat!');
    }
}
