<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Método para mostrar el formulario de inicio de sesión
    // Método para mostrar el formulario de inicio de sesión
public function showLoginForm()
{
    $oldData = session('loginData'); // Recupera los datos de sesión anteriores
    return view("welcomeLogin")->with("oldData", $oldData);
}

// Método para manejar el proceso de inicio de sesión
public function login(Request $request)
{
    // Validar los datos del formulario de inicio de sesión
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Intentar iniciar sesión con las credenciales proporcionadas
    if (Auth::attempt($credentials)) {
        // Si las credenciales son válidas, redirigir al usuario a la página deseada
        return redirect()->route('crud.index');
    }

    // Si las credenciales son incorrectas, redirigir de vuelta al formulario de inicio de sesión con un mensaje de error
    return back()->withErrors([
        'email' => 'Las credenciales proporcionadas no son válidas.',
    ])->withInput($request->except('password')); // Guarda los datos del formulario en la sesión
}


    // Método para cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}