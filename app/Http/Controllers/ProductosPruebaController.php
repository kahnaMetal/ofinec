<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ProductosPruebaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getIndex(){

      $productos = DB::table('productos')->orderBy('id', 'DESC')->where('Estado', 'activo')->where('Usuario_id', 1)->get();
      return view('prueba', array(
        'productos' => $productos
      ));
    }

    public function getProducto($id){
      $producto = DB::table('productos')->where('id', $id)->first();
      if(empty($producto)){
        return redirect()->action('ProductosPruebaController@getIndex');
      } else {
        return view('producto', array(
          'producto'  => $producto
        ));
      }
    }

    public function postProducto(Request $req){

      $image = $req->file('image');
      if($image){
        $image_path = $image->getClientOriginalName();
        \Storage::disk('productos')->put('1_'.$image_path, \File::get($image));
      } else {
        $image_path = '';
      }

      $producto = DB::table('productos')->insert(array(
        'ReferenciaProducto'          => $req->input('ReferenciaProducto'),
        'NombreProducto'              => $req->input('NombreProducto'),
        'Peso'                        => $req->input('Peso'),
        'Precio'                      => $req->input('Precio'),
        'FotoProducto'                => $image_path,
        'Cantidad'                    => $req->input('Cantidad'),
        'Categoria'                   => $req->input('Categoria'),
        'Estado'                      => 'activo',
        'Usuario_id'                  => 1
      ));

      return redirect()->action('ProductosPruebaController@getIndex');
    }

    public function getGuardarProducto(){
      return view('formularios.prueba');
    }

    public function getImgage($archivo){
      $user = \Auth::user();

      $file = Storage::disk('productos')->get($archivo);
      return new Response($file, 200);
    }

    public function getBorrarProducto($id){
      $producto = DB::table('productos')->where('id', $id)->delete();
      return redirect()->action('ProductosPruebaController@getIndex')->with('status', 'Producto eliminado correctamente');
    }

    public function postActualizarProducto($id, Request $req){

      $image = $req->file('image');
      if($image){
        $image_path = $image->getClientOriginalName();
        \Storage::disk('productos')->put('1_'.$image_path, \File::get($image));
      } else {
        $image_path = '';
      }

      $producto = DB::table('productos')->where('id', $id)->update(array(
        'ReferenciaProducto'          => $req->input('ReferenciaProducto'),
        'NombreProducto'              => $req->input('NombreProducto'),
        'Peso'                        => $req->input('Peso'),
        'Precio'                      => $req->input('Precio'),
        'FotoProducto'                => $image_path,
        'Cantidad'                    => $req->input('Cantidad'),
        'Categoria'                   => $req->input('Categoria'),
        'Estado'                      => $req->input('Estado'),
      ));

      return redirect()->action('ProductosPruebaController@getIndex')->with('status', 'Producto actualizado correctamente');
    }

    public function getActualizarProducto($id){
      $producto = DB::table('productos')->where('id', $id)->first();
      return view('formularios.prueba', array(
        'producto' => $producto
      ));
    }
}
