<?php

namespace App\Http\Controllers;

use App\Models\HistorialMedico;
use App\Models\Mascota;
use Illuminate\Http\Request;

class HistorialMedicoController extends Controller
{
    public function index()
    {
        $historial_medico = HistorialMedico::with('mascota')->get();
        $mascotas = Mascota::all();
        return view('historial_medico', compact('historial_medico', 'mascotas'));
    }

    public function store(Request $request)
    {
        HistorialMedico::create($request->all());
        return redirect()->route('historial_medico.index')->with('success', 'Historial médico agregado.');
    }

    public function update(Request $request, $id)
    {
        $historial_medico = HistorialMedico::findOrFail($id);
        $historial_medico->update($request->all());
        return redirect()->route('historial_medico.index')->with('success', 'Historial médico actualizado.');
    }

    public function destroy($id)
    {
        $historial_medico = HistorialMedico::findOrFail($id);
        $historial_medico->delete();

        return redirect()->route('historial_medico.index')->with('success', 'Historial médico eliminado.');
    }
}
