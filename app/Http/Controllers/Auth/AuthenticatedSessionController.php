<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Throwable;
use Illuminate\Database\QueryException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        try {
            //user
            $user = Auth::getProvider()->retrieveByCredentials($request->only('email','password'));
            //dd($user);
            // Verificar si el usuario existe y está activo
            if ($user && $user->state === 'Activo') {
                // Intentar autenticar al usuario
                if (Auth::attempt($request->only('email', 'password'))) {
                    // Regenerar la sesión
                    session()->regenerate();
                    // Redireccionar al panel con un mensaje de éxito
                    return redirect()->route('panel')->with('success', 'Bienvenido/a - '.$user->name);
                } else {
                    // Redireccionar de vuelta con un mensaje de error
                    return back()->with('danger', 'Correo electrónico o contraseña son os.');
                }
            } else {
                // Redireccionar de vuelta con un mensaje de error
                return back()->with('danger', 'Tu cuenta está inactiva o no existe.');
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
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }
}
