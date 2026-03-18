<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// importar el modelo
use App\Models\Libro;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //obtener informacion de la base de datos
        $libros = Libro::all();
        return view('libros.index', compact('libros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $libros= Libro::all();
        return view('libros.create',compact('libros'));
    }

    /**
     * Guardar informacion en la base de datos 
     */
    public function store(Request $request)
    {
        //mandar la informacion a la bd
        Libro::create([
            //<NombreFormulario> => $request <NombreBD>
            'nombre'=> $request ->nombre , 
            'autor'=> $request ->autor,
            'editorial' => $request -> editorial,
            'precio' => $request -> precio

        ]);

        //redireccionar al usuario al formulario
        return redirect()->route('libros.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Editar registro
     */
    public function edit(Libro $libro)
    {
        //
        return view('libros.edit', compact('libro'));
    }

    /**
     * Actualizar registro
     */
    public function update(Request $request, Libro $libro)
    {
        //
        $request->validate([
            'nombre' => 'required',
            'autor' => 'required',
            'editorial' => 'required',
            'precio' => 'required|numeric'
        ]);

        // Indicar actualización de todos los campos
        $libro->update($request->all());
        //Redirigir al usuario al index y enviarle mensaje
        return redirect()->route('libros.index')
        ->with('success', 'Actualización exitosa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Libro $libro)
    {
        // Función para eliminar un registro
        $libro -> delete();
        return redirect()->route('libros.index')
        ->with('success', 'Libro eliminado exitosamente');   
    }
}
