<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('deadline', 'asc')->get();

        return view('projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'deadline' => 'required|date',
            'status' => 'required',
        ]);

        Project::create([
            'name' => $request->name,
            'platform' => $request->platform ?? 'Web App',
            'client_name' => $request->client_name,
            'client_contact' => $request->client_contact,
            'client_institution' => $request->client_institution,
            'deadline' => $request->deadline,
            'status' => $request->status,
            'payment_status' => $request->payment_status ?? 'Belum Bayar',
            'demo_link' => $request->demo_link,
        ]);

        return back()->with('success', 'Project baru berhasil ditambahkan!');
    }

    public function exportPdf()
    {
        $projects = Project::orderBy('deadline', 'asc')->get();

        $pdf = Pdf::loadView('projects.pdf', compact('projects'));

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan-Project-Skillance.pdf');
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'client_name' => 'required',
            'status' => 'required',
        ]);

        $project->update($request->all());

        return back()->with('success', 'Data project berhasil diperbarui!');
    }
}
