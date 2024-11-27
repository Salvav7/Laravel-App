<?php 

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Mascota;
use App\Models\Servicio;
use Illuminate\Http\Request;

class CitasController extends Controller
{
    public function index()
    {
        $citas = Cita::with('mascota', 'servicio')->get();
        $mascotas = Mascota::all();
        $servicios = Servicio::all();

        return view('citas', compact('citas', 'mascotas', 'servicios'));
    }

    public function store(Request $request)
    {
        Cita::create($request->all());
        return redirect()->route('citas.index')->with('success', 'Cita agregada.');
        
    }

    public function update(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);
        $cita->update($request->all());
        return redirect()->route('citas.index')->with('success', 'Cita actualizada.');
    }


    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->update(['activo' => false]);

        return redirect()->route('citas.index')->with('success', 'Cita eliminada.');
    }
}
