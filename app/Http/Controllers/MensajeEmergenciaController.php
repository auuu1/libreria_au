<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//importar modelo 
use App\Models\MensajeEmergencia;

class MensajeEmergenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //obtener info de la bd
        $mensajeEmergencia = MensajeEmergencia::all();
        return view('mensajeEmergencia.index',compact('mensajeEmergencia'));
    }


    public function create()
    {
        //
        $mensajeEmergencia = MensajeEmergencia::all();
        return view('mensajeEmergencia.create',compact('mensajeEmergencia'));
    }

  
public function store(Request $request)
{
    try {
        MensajeEmergencia::create([
            'tipo_emergencia'       => $request->tipo_emergencia,
            'servicio_destinatario' => $request->servicio_destinatario,
            'medio_envio'           => $request->medio_envio,
            'contenido'             => $request->contenido,
            'ubicacion'             => $request->ubicacion,
            'fecha_envio'           => $request->fecha_envio,
            'estado_envio'          => $request->estado_envio,
        ]);

        return redirect()->route('mensajeEmergencia.index')
                         ->with('exito', '¡Emergencia registrada correctamente!');

    } catch (\Exception $e) {
        return back()->with('error', 'No se pudo guardar el mensaje');
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

  
    public function edit(MensajeEmergencia $mensajeEmergencia)
    {
        //
        return view('mensajeEmergencia.edit',compact('mensajeEmergencia'));
    }

    
    
  public function update(Request $request, MensajeEmergencia $mensajeEmergencia)
{
    $request->validate([
        'tipo_emergencia' => 'required',
        'servicio_destinatario' => 'required',
        'contenido' => 'required',
        'estado_envio' => 'required',
    ]);

    $mensajeEmergencia->update($request->all());

    return redirect()->route('mensajeEmergencia.index')
        ->with('success', 'Actualizacion exitosa');
}

    
    public function destroy(MensajeEmergencia $mensajeEmergencia)
    {
        //funcion para eliminar registro 
        $mensajeEmergencia -> delete();
        //
        return redirect()->route('mensajeEmergencia.index')
        ->with('success', 'Mensaje eliminado');
    }
}
