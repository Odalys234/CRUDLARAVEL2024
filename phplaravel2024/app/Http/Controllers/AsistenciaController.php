<?php
namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Estudiante;
use App\Models\Grupo;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Asistencia::query();

        if ($request->has('estudiante_id') && is_numeric($request->estudiante_id)) {
            $query->where('estudiante_id', '=', $request->estudiante_id);
        }

        if ($request->has('grupo_id') && is_numeric($request->grupo_id)) {
            $query->where('grupo_id', '=', $request->grupo_id);
        }

        if ($request->has('fecha')) {
            $query->whereDate('fecha', '=', $request->fecha);
        }

        $asistencias = $query->with('estudiante', 'grupo')
            ->orderBy('id', 'desc')
            ->simplePaginate(10);

        $estudiantes = Estudiante::all();
        $grupos = Grupo::all();
        return view('asistencias.index', compact('asistencias', 'estudiantes', 'grupos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estudiantes = Estudiante::all();
        $grupos = Grupo::all();
        return view('asistencias.create', compact('estudiantes', 'grupos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiante,id',
            'grupo_id' => 'required|exists:grupo,id',
            'fecha' => 'required|date',
            'hora_entrada' => 'required|date_format:H:i',
        ]);

        Asistencia::create($request->all());
        return redirect()->route('asistencias.index')->with('success', 'Asistencia creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $asistencia = Asistencia::find($id);

        if (!$asistencia) {
            return abort(404);
        }
        return view('asistencias.show', compact('asistencia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $asistencia = Asistencia::find($id);

        if (!$asistencia) {
            return abort(404);
        }
        $estudiantes = Estudiante::all();
        $grupos = Grupo::all();

        return view('asistencias.edit', compact('asistencia', 'estudiantes', 'grupos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $asistencia = Asistencia::find($id);

        if (!$asistencia) {
            return abort(404);
        }

        $request->validate([
            'estudiante_id' => 'required|exists:estudiante,id',
            'grupo_id' => 'required|exists:grupo,id',
            'fecha' => 'required|date',
            'hora_entrada' => 'required|date_format:H:i',
        ]);

        $asistencia->update($request->all());

        return redirect()->route('asistencias.index')->with('success', 'Asistencia actualizada correctamente');
    }

    /**
     * Show the form for deleting the specified resource.
     */
    public function delete($id)
    {
        $asistencia = Asistencia::find($id);

        if (!$asistencia) {
            return abort(404);
        }
        return view('asistencias.delete', compact('asistencia'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asistencia = Asistencia::find($id);

        if (!$asistencia) {
            return abort(404);
        }

        $asistencia->delete();

        return redirect()->route('asistencias.index')->with('success', 'Asistencia eliminada correctamente');
    }
}
