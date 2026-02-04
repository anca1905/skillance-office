<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Project;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOmzet = Transaction::where('type', 'income')->sum('amount');
        $activeProjects = Project::where('status', '!=', 'Selesai')->count();
        $pendingTasks = Project::where('status', 'Development')->count();
        $recentProjects = Project::orderBy('deadline', 'asc')->take(3)->get();

        $agendas = Agenda::where('is_completed', false)
            ->whereDate('date', '>=', now())
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->take(5)
            ->get();

        // dd($agendas);/

        return view('dashboard.index', compact('totalOmzet', 'activeProjects', 'pendingTasks', 'recentProjects', 'agendas'));
    }
}
