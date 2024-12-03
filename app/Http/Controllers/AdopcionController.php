<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Mascota;
use Illuminate\Http\Request;

class AdopcionController extends Controller
{
    public function index()
    {
        $adopciones = Adopcion::with('mascota')->get();
        $mascotas = Mascota::all();
        return view('adopciones', compact('adopciones', 'mascotas'));
    }

    public function store(Request $request)
    {
        Adopcion::create($request->all());
        return redirect()->route('adopciones.index')->with('success', 'Adopcion agregado.');
    }

    public function update(Request $request, $id)
    {
        $adopciones = Adopcion::findOrFail($id);
        $adopciones->update($request->all());
        return redirect()->route('adopciones.index')->with('success', 'Adopcion actualizado.');
    }

    public function destroy($id)
    {
        $adopciones = Adopcion::findOrFail($id);
        $adopciones->delete();

        return redirect()->route('adopciones.index')->with('success', 'Adopcion eliminado.');
    }
}

    