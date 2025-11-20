<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Additional_titles;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Throwable;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    //
    public function index(Request $request)
    {
        //Consultar los usuarios con rol Docente
        $teachers = User::Search($request->get('data'))
            ->State($request->get('state'))
            ->Role('Docente')
            ->paginate(10);

        $states = ['Activo', 'Inactivo'];

        return view('teachers.index', compact('teachers', 'states'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function store(Request $request)
    {
        try {
            $response = DB::transaction(function () use ($request) {

                // Buscar si el teacher ya existe
                $teacher = Teacher::where('user_id', $request->user_id)->first();

                if (!$teacher) {
                    $teacher = new Teacher();
                    $teacher->user_id = $request->user_id;
                }

                // Campos profesionales
                $teacher->professional_title = $request->professional_title ?? $teacher->professional_title;
                $teacher->linkedin = $request->linkedin ?? $teacher->linkedin;

                // Campo académico
                if ($request->has('linking_type')) {
                    $teacher->linking_type = $request->linking_type;
                }

                //Convertir asignaturas (array de objetos) en texto separado por coma
                if ($request->has('asignaturas') && is_array($request->asignaturas)) {
                    $asignaturas = collect($request->asignaturas)
                        ->pluck('asignatura')
                        ->filter()
                        ->implode(', ');
                    $teacher->assigned_subjects = $asignaturas;
                }

                //Convertir líneas (array de objetos) en texto separado por coma
                if ($request->has('lines') && is_array($request->lines)) {
                    $lines = collect($request->lines)
                        ->pluck('line')
                        ->filter()
                        ->implode(', ');
                    $teacher->research_lines = $lines;
                }

                // Guardar teacher
                if (!$teacher->save()) {
                    throw new \Exception('No se pudo guardar el docente.');
                }

                //Títulos adicionales
                if (!empty($request->titles) && is_array($request->titles)) {
                    Additional_titles::where('teacher_id', $teacher->id)->delete();

                    foreach ($request->titles as $titleData) {
                        $title = new Additional_titles();
                        $title->teacher_id = $teacher->id;
                        $title->title = $titleData['title'] ?? null;
                        $title->institution = $titleData['institution'] ?? null;
                        $title->graduation_year = $titleData['graduation_year'] ?? null;
                        $title->save();
                    }
                }

                return ['success', 'Información del docente guardada correctamente.'];
            });

            return response()->json([
                'type' => $response[0],
                'message' => $response[1]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'danger',
                'message' => $e->getMessage()
            ], 500);
        }
    }



    public function show(Teacher $teacher)
    {
        //
        $linking_types = [
            1 => 'Exclusivo',
            2 => 'Tiempo completo',
            3 => 'Medio tiempo',
            4 => 'Catedrático'
        ];

        //selecconar el tipo de enlace
        $teacher->linking_type_text = $linking_types[$teacher->linking_type];
        $teacher->assigned_subjects = explode(',', $teacher->assigned_subjects);
        return view('teachers.show', compact('teacher',));
    }

    public function update(Request $request, $user_id)
    {
        //
        $validated = $request->validate([
            'professional_title' => 'required|string|max:255',
            'linkedin' => 'nullable|url|max:255'
        ]);

        $teacher = Teacher::where('user_id', $user_id)->first();
        //Verificamos si el docente existe
        if (!isset($teacher)) {
            //Crear el docente
            $teacher = new Teacher();
            $teacher->user_id = $user_id;
        }

        $teacher->professional_title = $request->professional_title;
        $teacher->linkedin = $request->linkedin;

        $teacher->update($validated);
    }

    public function destroy(Teacher $teacher)
    {
        $response = DB::transation(function () use ($teacher) {
            //Inactivar el docente
            $teacher->state = false;
            //Inactivar el usuario asociado
            $user = User::find($teacher->id_user);
            $user->state = 'Inactivo';

            if (!$teacher->save()) {
                return ['danger', 'Contactar con los administradores.'];
            }

            if (!$user->save()) {
                DB::rollBack();
                return ['danger', 'Contactar con los administradores.'];
            }

            return ['success', 'Docente Eliminado.'];
        });

        return redirect()->route('teachers.index')->with($response[0], $response[1]);
    }

    public function addTitle(Request $request)
    {
        $teacher = Teacher::find($request->teacher_id);

        $title = new Additional_titles();
        $title->teacher_id = $request->teacher_id;
        $title->title = $request->title;
        $title->institution = $request->institution;
        $title->graduation_year = $request->graduation_year;

        if ($title->save()) {
            return response()->json(array('type' => 'success', 'message' => 'Título agregado.'));
        } else {
            return response()->json(array('type' => 'danger', 'message' => 'Error al agregar el título.'));
        }
    }

    /*Actualizar informaicon academica*/
    public function updateAcademicInformation(Request $request)
    {
        dd($request);
        $teacher = Teacher::find($request->teacher_id);

        //Validamos que el docente exista
        if (!isset($teacher)) {
            return response()->json(array('type' => 'danger', 'message' => 'Error al actualizar la información.'));
        }

        $$teacher->research_lines = (isset($request->research_lines)) ? json_encode($request->research_lines) : '';

        if ($teacher->save()) {
            return response()->json(array('type' => 'success', 'message' => 'Información actualizada.'));
        } else {
            return response()->json(array('type' => 'danger', 'message' => 'Error al actualizar la información.'));
        }
    }
}