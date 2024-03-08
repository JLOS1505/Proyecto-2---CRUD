<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudEncargadoController extends Controller
{
    public function index()
    {
        $datos = DB::select("select * from encargado");
        return view("welcomeEncargado")->with("datos", $datos);
    }

    public function create(Request $request)
    {
         // Validar que los campos numéricos sean números
         if (!is_numeric($request->txtcodigo)|| $request->txtcodigo < 0) {
            return back()->withInput()->with("incorrecto", "Error: Carácter no valido en ID (solo numeros)");
        }
        if (!is_numeric($request->txtsueldo)|| $request->txtsueldo < 0) {
            return back()->withInput()->with("incorrecto", "Error: Carácter no valido en Sueldo (solo numeros).");
        }

        // Validar que los campos de nombre y área contengan solo caracteres
        if (!preg_match("/^[a-zA-Z\s]+$/", $request->txtnombre)) {
            return back()->withInput()->with("incorrecto", "Error: Carácter '{$request->txtnombre}' no valido en Nombre");
        }
        
        // Validar que el ID no exista en la base de datos
        $existingID = DB::table('encargado')->where('id_usuario', $request->txtcodigo)->exists();
        if ($existingID) {
             return back()->withInput()->with("incorrecto", "Error: El ID '{$request->txtcodigo}' ya existe en la base de datos.");
        }

        try {
            $sql = DB::insert("insert into encargado(id_usuario, nombre, area, sueldo)values(?, ?, ?, ?) ", [
                $request->txtcodigo,
                $request->txtnombre,
                $request->txtarea,
                $request->txtsueldo
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Encargado registrado correctamente");
        } else {
            return back()->with("incorrecto", "Error el registrar");
        }
    }

    public function update(Request $request)
    {
        // Validar que los campos numéricos sean números
        if (!is_numeric($request->txtcodigo)|| $request->txtcodigo < 0) {
            return back()->with("incorrecto", "Error: Carácter no valido en ID (solo numeros).");
        }
        if (!is_numeric($request->txtsueldo)|| $request->txtsueldo < 0) {
            return back()->with("incorrecto", "Error: Carácter no valido en Sueldo (solo numeros).");
        }

        // Validar que los campos de nombre y área contengan solo caracteres
        if (!preg_match("/^[a-zA-Z\s]+$/", $request->txtnombre)) {
            return back()->with("incorrecto", "Error: Carácter no valido en Nombre");
        }

        try {
            $sql = DB::update("update encargado set nombre=?, area=?, sueldo=? where id_usuario=?", [
                $request->txtnombre,
                $request->txtarea,
                $request->txtsueldo,
                $request->txtcodigo,
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error al modificar el producto");
        }
        if ($sql == true) {
            return back()->with("correcto", "Encargado modificado correctamente");
        } else {
            return back()->with("incorrecto", "Error el modificar");
        }
    }

    public function delete($id)
    {
        if (!is_numeric($id)) {
            return back()->with("incorrecto", "Error: Carácter no valido en ID (solo numeros)");
        }

        try {
            $sql = DB::delete("delete from encargado where id_usuario=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Encargado eliminado correctamente");
        } else {
            return back()->with("incorrecto", "Error el eliminar el Encargado");
        }
    }
}
