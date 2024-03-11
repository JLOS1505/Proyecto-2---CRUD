<?php

namespace App\Http\Controllers\Auth;;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Método para mostrar el formulario de registro
    public function showRegistrationForm()
    {
        $datos = DB::select("select * from users");
        return view("welcomeRegistro")->with("datos", $datos);
        
    }

    // Método para procesar la solicitud de registro
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear un nuevo usuario
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // Autenticar al usuario recién registrado
        auth()->login($user);

        // Redirigir al usuario a la página deseada
        return redirect()->route('login');
    }
}