<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ComprarProductosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getIndex(){
      $user = Auth::user();

      $productos = DB::table('productos')->orderBy('id', 'DESC')->where('Estado', 'activo')->where('Usuario_id', '<>', $user->id)->where('Usuario_id', '<>', 1)->get();
      return view('comprarproductos', array(
        'productos' => $productos
      ));
    }

    public function getProducto($id){
      $producto = DB::table('productos')->where('id', $id)->first();
      if(empty($producto)){
        return redirect()->action('ComprarProductosController@getIndex');
      } else {
        return view('producto', array(
          'producto'  => $producto
        ));
      }
    }

    public function getImgage($archivo){
      $file = Storage::disk('productos')->get($archivo);
      return new Response($file, 200);
    }

    public function getComprar($id){
      $producto = DB::table('productos')->where('id', $id)->first();
      if(empty($producto)){
        return redirect()->action('ComprarProductosController@getIndex');
      } else {
        return view('producto', array(
          'producto'  => $producto,
          'comprar'   => TRUE
        ));
      }
    }

    public function postComprar($id, Request $req){
      $user = Auth::user();

      $actualizaProducto = DB::table('productos')->where('id', $id)->decrement('Cantidad', $req->input('qty'));

      /*$compra = DB::table('compras')->insert(array(
        'Usuario_id'          => $user->id,
        'Producto_id'         => $id,
        'Valor'               => $req->input('valorU'),
        'Cantidad'            => $req->input('qty'),
        'Fecha'               => date('Y-m-d'),
      ));*/

      return redirect()->action('ComprarProductosController@getIndex')->with('status', 'Producto comprado correctamente');
    }
}
