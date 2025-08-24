<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $document_types =  ['NIT','CC','CE','PASAPORTE'];
        return view('auth.register',compact('document_types'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'document_number' => ['required', 'string', 'min:6', 'max:10' , 'unique:'.User::class],
            'contact_number' => ['required', 'string', 'min:10', 'max:10' , 'unique:'.User::class],
            'password' => 'required|min:8|same:confirm-password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'document_number' => $request->document_number,
            'contact_number' => $request->contact_number,
            'state' => 'Activo',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
