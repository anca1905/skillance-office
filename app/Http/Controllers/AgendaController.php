<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'time' => 'required',
            'date' => 'required',
            'priority' => 'required'
        ]);

        Agenda::create($request->all());

        return back()->with('success', 'Agenda berhasil dijadwalkan!');
    }

    public function complete($id)
    {
        $agenda = Agenda::find($id);
        $agenda->update(['is_completed' => true]);

        return back()->with('success', 'Agenda ditandai selesai.');
    }

    public function destroy($id)
    {
        Agenda::destroy($id);
        return back();
    }
}
