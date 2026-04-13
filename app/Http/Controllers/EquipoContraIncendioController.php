<?php

namespace App\Http\Controllers;

use App\Models\EquipoContraIncendio;
use Illuminate\Http\Request;

class EquipoContraIncendioController extends Controller
{
    // 1. Mostrar la tabla con todos los equipos
    public function index()
    {
        $equipos = EquipoContraIncendio::all();
        return view('equipos.index', compact('equipos'));
    }

    // 2. Mostrar el formulario para registrar un nuevo equipo
    public function create()
    {
        return view('equipos.create');
    }

    // 3. Guardar el nuevo equipo en la base de datos
    public function store(Request $request)
    {
        // Validamos que los datos obligatorios vengan en el formulario
        $request->validate([
            'codigo_equipo' => 'required|unique:equipo_contra_incendios',
            'tipo' => 'required',
            'ubicacion_exacta' => 'required',
            'estado' => 'required'
        ]);

        try {
            // Guardamos todo de golpe gracias al $fillable que configuraste antes
            EquipoContraIncendio::create($request->all());
            
            return redirect()->route('equipos.index')
                             ->with('success', '¡Equipo contra incendio registrado correctamente!');
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo guardar el equipo. Revisa los datos.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EquipoContraIncendio $equipoContraIncendio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $equipo = EquipoContraIncendio::findOrFail($id);
        return view('equipos.edit', compact('equipo'));
    }

    public function update(Request $request, $id)
        {
            try {
                // 1. Buscamos el equipo manualmente por su ID (como hicimos en edit)
                $equipo = EquipoContraIncendio::findOrFail($id);

                // 2. Validamos los datos
                $request->validate([
                    'codigo_equipo' => 'required|string|max:255',
                    'tipo' => 'required|string',
                    'ubicacion_exacta' => 'required|string|max:255',
                    'fecha_ultima_recarga' => 'nullable|date',
                    'fecha_caducidad' => 'nullable|date',
                    'estado' => 'required|string',
                ]);

                // 3. Actualizamos el registro encontrado
                $equipo->update([
                    'codigo_equipo' => $request->codigo_equipo,
                    'tipo' => $request->tipo,
                    'ubicacion_exacta' => $request->ubicacion_exacta,
                    'fecha_ultima_recarga' => $request->fecha_ultima_recarga,
                    'fecha_caducidad' => $request->fecha_caducidad,
                    'estado' => $request->estado,
                ]);

                return redirect()->route('equipos.index')
                                ->with('exito', '¡Equipo actualizado correctamente!');

            } catch (\Exception $e) {
                // Puse $e->getMessage() temporalmente para que, si falla, te diga EXACTAMENTE por qué
                return back()->with('error', 'No se pudo actualizar: ' . $e->getMessage());
            }
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
        {
            try {
                // Buscamos el equipo manualmente por su ID
                $equipo = EquipoContraIncendio::findOrFail($id);
                
                // Lo eliminamos
                $equipo->delete();

                return redirect()->route('equipos.index')
                                ->with('exito', '¡Equipo eliminado correctamente!');

            } catch (\Exception $e) {
                // Mostramos el error exacto si algo falla
                return back()->with('error', 'No se pudo eliminar el equipo: ' . $e->getMessage());
            }
        }
}
