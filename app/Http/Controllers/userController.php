<?php

namespace App\Http\Controllers;


use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Database\QueryException;
use Throwable;

class userController extends Controller
{

    /*
    function __construct()
    {
        //$this->middleware('can:permisos-eliminar|permisos-crear|permisos-editar', ['only' => ['index','show']]);
        $this->middleware('can:ver-user', ['only' => ['index', 'show']]);
        $this->middleware('can:editar-user', ['only' => ['update', 'edit']]);
        $this->middleware('can:crear-user', ['only' => ['store', 'create']]);
        $this->middleware('can:eliminar-user', ['only' => ['destroy']]);
    } */
    public function index(Request $request)
    {
        try {
            $users = User::Search($request->get('data'))
            ->State($request->get('state'))
            ->Role($request->get('rol'))
            ->orderBy('id','DESC')
            ->paginate(10);

            $states = ['Activo','Inactivo'];
            $roles = Role::pluck('name','name')->all();

            return view('users.index', compact('users','states','roles'))
            ->with('i', ($request->input('page', 1) - 1) * 10);

        } catch (QueryException $e) {
            //Retornar a la vista anterior
            return redirect()->back()->with('danger', 'Contactar con los administradores.');
        } catch (Throwable  $e) {
            // Manejo de otros tipos de excepciones
            return redirect()->back()->with('danger', 'Ha ocurrido un error inesperado. Por favor, intente nuevamente.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'document_number' => ['required', 'string', 'min:6', 'max:10' , 'unique:'.User::class],
            'contact_number' => ['required', 'string', 'min:10', 'max:10' , 'unique:'.User::class],
            'roles' => 'required',
            'state' => 'required',
            'password' => 'required|min:8|same:confirm-password',
        ]);

        try{
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);

            User::create($input)->syncRoles($request->input('roles'));

            return redirect()->route('users.index')->with('success', 'Usuario Registrado.');
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
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        //Octener rol del user
        $roleUser = $user->getRoleNames()->first();

        return response()->json(array('user' => $user, 'roles' => $roles , 'roleUser' => $roleUser));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email,'.$user->id.',id',
            'document_number' => 'required|string|min:6|max:10|unique:users,document_number,'.$user->id.',id',
            'contact_number' => 'required|string|min:10|max:10|unique:users,contact_number,'.$user->id.',id',
            'roles' => 'required',
            'state' => 'required',
            'password' => 'nullable|min:8|same:confirm-password',
        ]);


        try{
            $user->name = $request->name;
            $user->document_number = $request->document_number;
            $user->contact_number = $request->contact_number;          
            $user->email = $request->email;
            $user->state = $request->state;

            if(!empty($request->password)){
                $user->password = Hash::make($request->password);
            }


            if($user->save()){
                if(!empty($request->input('roles'))){
                    DB::table('model_has_roles')->where('model_id',$user->id)->delete();
                    $user->syncRoles($request->input('roles'));
                }

                return redirect()->route('users.index')
                            ->with('success','Usuario Actualizado');

            }else{
                return redirect()->route('users.index')
                            ->with('warning'," No se actualizo el usuario");
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::find($id);

            //Eliminar rol
            $rolUser = $user->getRoleNames()->first();
            $user->removeRole($rolUser);

            //Eliminar usuario
            $user->delete();

            return redirect()->route('users.index')->with('success','Usuario Eliminado.');
        } catch (QueryException $e) {
            //Retornar a la vista anterior
            return redirect()->back()->with('danger', 'Contactar con los administradores.');
        } catch (Throwable  $e) {
            // Manejo de otros tipos de excepciones
            return redirect()->back()->with('danger', 'Ha ocurrido un error inesperado. Por favor, intente nuevamente.');
        }
    }
}
