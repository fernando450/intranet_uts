<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class roleController extends Controller
{
    /*function __construct()
    {
        //$this->middleware('can:permisos-eliminar|permisos-crear|permisos-editar', ['only' => ['index','show']]);
        $this->middleware('can:ver-role', ['only' => ['index', 'show']]);
        $this->middleware('can:editar-role', ['only' => ['update', 'edit']]);
        $this->middleware('can:crear-role', ['only' => ['store', 'create']]);
        $this->middleware('can:eliminar-role', ['only' => ['destroy']]);
    }*/

    public function index(Request $request)
    {
        try{
            //->Buscar($request->get('name'))
            $roles = Role::orderBy('id','DESC')->latest()->paginate(5);
            $permissions = Permission::get();
            return view('roles.index',compact('roles','permissions'))
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
                'name' => 'required|unique:roles,name,NULL,id,guard_name,web',
            ]);

            $rol = Role::create(['name' => $request->input('name')]);

            if(!empty($request->input('permissions'))){
                $rol->syncPermissions($request->input('permissions'));
            }

            return redirect()->route('roles.index')
                            ->with('success','Rol Creado');
        } catch (QueryException $e) {
            //Retornar a la vista anterior
            return redirect()->back()->with('danger', 'Contactar con los administradores.');
        } catch (Throwable  $e) {
            // Manejo de otros tipos de excepciones
            return redirect()->back()->with('danger', 'Contactar con los administradores.');
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
        $rol = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('role.show',compact('rol','rolePermissions'));
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
            $rol = Role::find($id);

            //dd('entro');
            $permissions = array();
            if(!empty($rol->permissions)){
                foreach($rol->permissions as $permiso){
                    $permissions[] = str($permiso->id);
                }
            }
            //dd($permissions);
            return response()->json(array('permissions' => $permissions,'rol' => $rol));
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
    public function update(Request $request, Role $role)
    {
        try{
            $request->validate([
                'name' => 'required|unique:roles,name,NULL,id,guard_name,web',
                'permissions' => 'required|array',
            ]);

            $role->name = $request->input('name');
            $role->save();

            $permissions = Permission::whereIn('id', $request->input('permissions'))->get();
            $role->syncPermissions($permissions);

            return redirect()->route('roles.index')
                    ->with('success', 'Rol actualizado');

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
            DB::table("roles")->where('id',$id)->delete();
            return redirect()->route('roles.index')
                            ->with('success','Rol eliminado');
        } catch (QueryException $e) {
            //Retornar a la vista anterior
            return redirect()->back()->with('danger', 'Contactar con los administradores.');
        } catch (Throwable  $e) {
            // Manejo de otros tipos de excepciones
            return redirect()->back()->with('danger', 'Contactar con los administradores.');
        }
    }
}
