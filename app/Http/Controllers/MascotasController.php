<?php
namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;

class MascotasController extends Controller
{
    public function index()
    {
        $mascotas = Mascota::all();
        return view('mascotas', compact('mascotas'));
    }

    public function store(Request $request)
    {
        Mascota::create($request->all());
        return redirect()->route('mascotas.index')->with('success', 'Mascota agregada.');
    }

    public function update(Request $request, $id)
    {
        $mascota = Mascota::findOrFail($id);
        $mascota->update($request->all());
        return redirect()->route('mascotas.index')->with('success', 'Mascota actualizada.');
    }

    public function destroy($id)
    {
        $mascota = Mascota::findOrFail($id);
        $mascota->update(['activo' => false]);
    
        return redirect()->route('mascotas.index')->with('success', 'Mascota eliminada.');
    }
}
