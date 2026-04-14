<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MensajeEmergencia;
use App\Services\GmailService;

class MensajeEmergenciaController extends Controller
{
    public function index()
    {
        $mensajeEmergencia = MensajeEmergencia::all();
        return view('mensajeEmergencia.index', compact('mensajeEmergencia'));
    }

    public function create()
    {
        return view('mensajeEmergencia.create');
    }

    public function store(Request $request, GmailService $gmail)
    {
        $request->validate([
            'tipo_emergencia'       => 'required',
            'servicio_destinatario' => 'required',
            'medio_envio'           => 'required',
            'contenido'             => 'required',
            'ubicacion'             => 'required',
            'fecha_envio'           => 'required',
            'estado_envio'          => 'required',
        ]);

        try {
            // Guardar como pendiente
            $mensaje = MensajeEmergencia::create([
                'tipo_emergencia'       => $request->tipo_emergencia,
                'servicio_destinatario' => $request->servicio_destinatario,
                'medio_envio'           => $request->medio_envio,
                'contenido'             => $request->contenido,
                'ubicacion'             => $request->ubicacion,
                'fecha_envio'           => $request->fecha_envio,
                'estado_envio'          => 'pendiente',
            ]);

            // Solo si es correo
            if ($request->medio_envio === 'correo') {

                $correoDestino = "hrzarturo1@gmail.com";

                $asunto = "🚨 Emergencia: " . $mensaje->tipo_emergencia;

                $cuerpo = "
                    <h2>🚨 Emergencia detectada</h2>
                    <p><strong>Servicio:</strong> {$mensaje->servicio_destinatario}</p>
                    <p><strong>Tipo:</strong> {$mensaje->tipo_emergencia}</p>
                    <p><strong>Contenido:</strong> {$mensaje->contenido}</p>
                    <p><strong>Ubicación:</strong> {$mensaje->ubicacion}</p>
                    <p><strong>Fecha:</strong> {$mensaje->fecha_envio}</p>
                ";

                try {
                    $gmail->sendEmail(
                        $correoDestino,
                        $asunto,
                        $cuerpo
                    );

                    // Si se envía bien
                    $mensaje->update(['estado_envio' => 'enviado']);

                } catch (\Exception $e) {
                    // Si falla el envío
                    $mensaje->update(['estado_envio' => 'fallido']);
                }
            }

            return redirect()->route('mensajeEmergencia.index')
                ->with('success', '¡Emergencia registrada y correo enviado!');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al registrar la emergencia');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(MensajeEmergencia $mensajeEmergencia)
    {
        return view('mensajeEmergencia.edit', compact('mensajeEmergencia'));
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
            ->with('success', 'Actualización exitosa');
    }

    public function destroy(MensajeEmergencia $mensajeEmergencia)
    {
        $mensajeEmergencia->delete();

        return redirect()->route('mensajeEmergencia.index')
            ->with('success', 'Mensaje eliminado');
    }
}