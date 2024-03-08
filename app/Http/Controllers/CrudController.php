<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    public function index()
    {
        $datos = DB::select("select * from producto");
        return view("welcome")->with("datos", $datos);
    }

    public function create(Request $request)
    {
        // Validar que los campos numéricos sean números
        if (!is_numeric($request->txtcodigo)|| $request->txtcodigo < 0) {
            return back()->withInput()->with("incorrecto", "Error: Carácter no valido en ID (solo numeros)");
        }
        if (!is_numeric($request->txtprecio)|| $request->txtprecio < 0) {
            return back()->withInput()->with("incorrecto", "Error: Carácter no valido en precio (solo numeros).");
        }
        if (!is_numeric($request->txtcantidad)|| $request->txtcantidad < 0) {
            return back()->withInput()->with("incorrecto", "Error: Carácter no valido en Cantidad (solo numeros).");
        }

        if (!preg_match("/^[a-zA-Z\s]+$/", $request->txtnombre)) {
            return back()->withInput()->with("incorrecto", "Error: Carácter '{$request->txtnombre}' no valido en Nombre");
        }
        
        // Validar que el ID no exista en la base de datos
        $existingID = DB::table('producto')->where('id_producto', $request->txtcodigo)->exists();
        if ($existingID) {
             return back()->withInput()->with("incorrecto", "Error: El ID '{$request->txtcodigo}' ya existe en la base de datos.");
        }

        try {
            $sql = DB::insert("insert into producto(id_producto, nombre, precio, cantidad)values(?, ?, ?, ?) ", [
                $request->txtcodigo,
                $request->txtnombre,
                $request->txtprecio,
                $request->txtcantidad
            ]);
        } catch (\Throwable $th) {
            return back()->withInput()->with("incorrecto", "Error al registrar el producto");
        }

        if ($sql == true) {
            return back()->with("correcto", "Producto registrado correctamente");
        } else {
            return back()->withInput()->with("incorrecto", "Error al registrar el producto");
        }
    }

    public function update(Request $request)
    {
        // Validar que los campos numéricos sean números
        if (!is_numeric($request->txtcodigo)|| $request->txtcodigo < 0) {
            return back()->with("incorrecto", "Error: Carácter no valido en ID (solo numeros).");
        }
        if (!is_numeric($request->txtprecio)|| $request->txtprecio < 0) {
            return back()->with("incorrecto", "Error: Carácter no valido en precio (solo numeros).");
        }
        if (!is_numeric($request->txtcantidad)|| $request->txtcantidad < 0) {
            return back()->with("incorrecto", "Error: Carácter no valido en Cantidad (solo numeros).");
        }

        if (!preg_match("/^[a-zA-Z\s]+$/", $request->txtnombre)) {
            return back()->withInput()->with("incorrecto", "Error: Carácter '{$request->txtnombre}' no valido en Nombre");
        }

        $existingID = DB::table('producto')->where('id_producto', $request->txtcodigo)->exists();
        if ($existingID) {
             return back()->withInput()->with("incorrecto", "Error: El ID '{$request->txtcodigo}' ya existe en la base de datos.");
        }

        try {
            $sql = DB::update("update producto set nombre=?, precio=?, cantidad=? where id_producto=?", [
                $request->txtnombre,
                $request->txtprecio,
                $request->txtcantidad,
                $request->txtcodigo,
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error al modificar el producto");
        }
        if ($sql == true) {
            return back()->with("correcto", "Producto modificado correctamente");
        } else {
            return back()->with("incorrecto", "Error al modificar el producto");
        }
    }

    public function delete($id)
    {
        // Validar que el ID sea un número
        if (!is_numeric($id)) {
            return back()->with("incorrecto", "Error: Carácter no valido en ID (solo numeros)");
        }

        try {
            $sql = DB::delete("delete from producto where id_producto=$id");
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error al eliminar el producto");
        }

        if ($sql == true) {
            return back()->with("correcto", "Producto eliminado correctamente");
        } else {
            return back()->with("incorrecto", "Error al eliminar el producto");
        }
    }
}
