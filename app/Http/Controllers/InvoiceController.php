<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Project;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::orderBy('created_at', 'desc')->get();
        return view('finance.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $projects = Project::all(); // Untuk dropdown pilih klien

        // Generate Nomor Invoice Otomatis (Contoh: INV-2026001)
        $lastInv = Invoice::latest()->first();
        $number = $lastInv ? intval(substr($lastInv->invoice_number, 8)) + 1 : 1;
        $newInvNumber = 'INV-' . date('Y') . sprintf('%03d', $number);

        return view('finance.invoices.create', compact('projects', 'newInvNumber'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required',
            'invoice_date' => 'required',
            'items' => 'required|array',
            'items.*.desc' => 'required',
            'items.*.price' => 'required|numeric',
        ]);

        // 1. Simpan Kepala Invoice
        $invoice = Invoice::create([
            'invoice_number' => $request->invoice_number,
            'project_id' => $request->project_id,
            'client_name' => $request->client_name,
            'client_address' => $request->client_address,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'status' => 'UNPAID'
        ]);

        // 2. Simpan Item-itemnya
        foreach ($request->items as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => $item['desc'],
                'qty' => $item['qty'],
                'price' => $item['price'],
                'total' => $item['qty'] * $item['price']
            ]);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice berhasil dibuat!');
    }

    public function printPdf($id)
    {
        $invoice = Invoice::with('items')->findOrFail($id);

        $pdf = Pdf::loadView('finance.invoices.pdf', compact('invoice'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Invoice-' . $invoice->invoice_number . '.pdf');
    }

    // Fitur Tandai Lunas
    public function markAsPaid($id)
    {
        Invoice::where('id', $id)->update(['status' => 'PAID']);
        return back()->with('success', 'Status Invoice diubah menjadi LUNAS.');
    }
}
