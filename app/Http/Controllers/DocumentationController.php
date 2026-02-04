<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ProjectDocumentation;
use Illuminate\Support\Facades\Storage;

class DocumentationController extends Controller
{
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);
        $docs = ProjectDocumentation::where('project_id', $projectId)->orderBy('sort_order')->get();
        return view('projects.documentation', compact('project', 'docs'));
    }

    // Simpan Data
    public function store(Request $request, $projectId)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|max:2048',
            'description' => 'required',
        ]);

        $path = $request->file('image')->store('docs', 'public');

        ProjectDocumentation::create([
            'project_id' => $projectId,
            'title' => $request->title,
            'image_path' => $path,
            'description' => $request->description,
            'sort_order' => ProjectDocumentation::where('project_id', $projectId)->count() + 1
        ]);

        return back()->with('success', 'Halaman berhasil ditambahkan!');
    }

    // Hapus Data
    public function destroy($id)
    {
        $doc = ProjectDocumentation::findOrFail($id);
        Storage::disk('public')->delete($doc->image_path);
        $doc->delete();
        return back();
    }

    // --- CETAK BUKU LAPORAN ---
    public function printPdf($projectId)
    {
        $project = Project::findOrFail($projectId);
        $docs = ProjectDocumentation::where('project_id', $projectId)->orderBy('sort_order')->get();

        $pdf = Pdf::loadView('projects.report_pdf', compact('project', 'docs'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan-Resmi-' . $project->client_name . '.pdf');
    }

    // FUNGSI BARU: UPLOAD COVER
    public function uploadCover(Request $request, $projectId)
    {
        $request->validate([
            'cover' => 'required|image|max:4096', // Max 4MB biar tajam
        ]);

        $project = Project::findOrFail($projectId);

        // Hapus cover lama jika ada (biar hemat storage)
        if ($project->cover_image && Storage::disk('public')->exists($project->cover_image)) {
            Storage::disk('public')->delete($project->cover_image);
        }

        // Simpan cover baru
        $path = $request->file('cover')->store('project-covers', 'public');

        $project->update(['cover_image' => $path]);

        return back()->with('success', 'Cover laporan berhasil diperbarui!');
    }
}
