<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Teacher;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $teacher  = Auth::user()->teacher ?? null;
        $titles   = $teacher?->additional_titles ?? null;

        // Reconstruir asignaturas y líneas como arreglos de objetos
        $asignaturas = [];
        $lines = [];

        if (!empty($teacher?->assigned_subjects)) {
            $asignaturas = array_map(function ($item) {
                return ['asignatura' => trim($item)];
            }, explode(',', $teacher->assigned_subjects));
        }

        if (!empty($teacher?->research_lines)) {
            $lines = array_map(function ($item) {
                return ['line' => trim($item)];
            }, explode(',', $teacher->research_lines));
        }

        return view('profile.show', compact('teacher', 'titles', 'asignaturas', 'lines'));

    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contact_number' => 'required|string|min:10|max:10|unique:users,contact_number,'.Auth::user()->id.',id',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email,'.Auth::user()->id.',id',
            'second_email' => 'nullable|string|lowercase|email|max:255',
            'second_phone' => 'nullable|string|min:10|max:10'
        ]);

        auth()->user()->update($request->all());

        $teacher = Teacher::where('user_id', auth()->user()->id)->first();

        //Verificamos si el docente ya existe
        if(!isset($teacher)){
            $teacher = new Teacher();
            $teacher->user_id = auth()->user()->id;
        }

        $teacher->second_email = $request->second_email;
        $teacher->second_phone = $request->second_phone;

        if(!$teacher->save()){
            return redirect()->back()->with('danger', 'Error al actualizar el perfil.');
        }

        return redirect()->back()->with('success', 'Perfil actualizado exitosamente.');
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'min:8|same:confirm-password'
        ]);

        $password_old = auth()->user()->password;

        if (Hash::check($request->old_password, $password_old)) {
            auth()->user()->update(['password' => Hash::make($request->get('password'))]);
            
            return redirect()->back()->with('success', 'Contraseña actualizada exitosamente');
        } else {
            // La contraseña no es válida
            return redirect()->back()->with('warning', 'La contraseña anterior no conside');
        }

    }

    public function imagen( Request $request)
    {
        //
        $request->validate([
            'ruta_foto' => 'required|mimes:jpg,jpeg,png|max:10000'
        ]);

        //Declaramos la ruta
        $directory = 'users/'.Auth::user()->id.'/ruta_foto';

        //si no existe el directorio lo creamos
        if(!file_exists($directory)){
            //Creamos directorio
            Storage::makeDirectory($directory);
        }


        //tipo de archivo
        $extension = strtolower($request->ruta_foto->getClientOriginalExtension());

        //nombre del archivo
        $nombre = 'avatar';

        //declaramos la ruta del archivo
        $ruta_archivo= $directory.'/'.$nombre.'.'.$extension;


        //indicamos que queremos guardar y eliminar el que existe en el directorio
        $eliminar_existente = User::find(Auth::user()->id);


        if (!empty($eliminar_existente->ruta_foto)){

            if(Storage::exists($eliminar_existente->ruta_foto)){
                Storage::delete($eliminar_existente->ruta_foto);
            }
        }

        Storage::put($ruta_archivo, \File::get($request->ruta_foto));

        $existe = Storage::exists($ruta_archivo);

        if($existe){
            User::where('id',Auth::user()->id)
            ->update([
                'ruta_foto' => $ruta_archivo
            ]);
        }

        return back()->with('notification', ['type' => 'success', 'message' => 'Avatar actualizado exitosamente']);
    }
}
