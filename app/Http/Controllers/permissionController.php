<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Throwable;

class PermissionController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*function __construct()
    {
        //$this->middleware('can:permisos-eliminar|permisos-crear|permisos-editar', ['only' => ['index','show']]);
        $this->middleware('can:listar-permiso', ['only' => ['index', 'show']]);
        $this->middleware('can:editar-permiso', ['only' => ['update', 'edit']]);
        $this->middleware('can:crear-permiso', ['only' => ['store', 'create']]);
        $this->middleware('can:eliminar-permiso', ['only' => ['destroy']]);
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $permissions = Permission::Buscar($request->get('name'))->latest()->paginate(5);
            return view('permissions.index', compact('permissions'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        } catch (QueryException $e) {
            //Retornar a la vista anterior
            return redirect()->back()->with('danger', 'Contactar con los administradores.');
        } catch (Throwable  $e) {
            // Manejo de otros tipos de excepciones
            return redirect()->back()->with('danger', 'Contactar con los administradores.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|unique:permissions,name',
            ]);

            $permission = new Permission();
            $permission->name = strtolower($request->name);

            if ($permission->save()) {
                return redirect()->route('permissions.index')
                    ->with('success', 'Permiso creado.');
            } else {
                return redirect()->route('permissions.index')
                    ->with('danger', "Error al crear el permiso.");
            }

        } catch (QueryException $e) {
            //Retornar a la vista anterior
            return redirect()->back()->with('danger', 'Contactar con los administradores.');
        } catch (Throwable  $e) {
            // Manejo de otros tipos de excepciones
            return redirect()->back()->with('danger', 'Ha ocurrido un error inesperado. Por favor, intente nuevamente.');
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $permission = Permission::findOrFail($id);
            //dd($permission);
            return response()->json(array('permission' => $permission));
        } catch (QueryException $e) {
            //Retornar a la vista anterior
            return redirect()->back()->with('danger', 'Contactar con los administradores.');
        } catch (Throwable  $e) {
            // Manejo de otros tipos de excepciones
            return redirect()->back()->with('danger', 'Contactar con los administradores.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $permission)
    {
        try{
            $request->validate([
                'name' => 'required|unique:permissions,name,'.$permission,
            ]);
            
            $permission = Permission::find($permission);
            $permission->name = strtolower($request->name);

            if ($permission->save()) {
                return redirect()->route('permissions.index')
                    ->with('success', 'Permiso actualizado.');
            } else {
                return redirect()->route('permissions.index')
                    ->with('danger', "Eror al actualizar el permiso.");
            }
        } catch (QueryException $e) {
            //Retornar a la vista anterior
            return redirect()->back()->with('danger', 'Contactar con los administradores.');
        } catch (Throwable  $e) {
            // Manejo de otros tipos de excepciones
            return redirect()->back()->with('danger', 'Contactar con los administradores.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::table("permissions")->where('id', $id)->delete();
            return redirect()->route('permissions.index')
                ->with('success', 'Permiso eliminado');
        
        } catch (QueryException $e) {
            //Retornar a la vista anterior
            return redirect()->back()->with('danger', 'Contactar con los administradores.');
        } catch (Throwable  $e) {
            // Manejo de otros tipos de excepciones
            return redirect()->back()->with('danger', 'Contactar con los administradores.');
        }
    }

    public function scopeBuscar($query, $name)
    {
        if (!empty($name)) {
            $query->where("name", "like", "%$name%");
        }
    }

}
