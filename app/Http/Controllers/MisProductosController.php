<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MisProductosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getIndex(){
      $user = Auth::user();

      $productos = DB::table('productos')->orderBy('id', 'DESC')->where('Estado', 'activo')->where('Usuario_id', $user->id)->get();
      return view('misproductos', array(
        'productos' => $productos
      ));
    }

    public function getProducto($id){
      $producto = DB::table('productos')->where('id', $id)->first();
      if(empty($producto)){
        return redirect()->action('MisProductosController@getIndex');
      } else {
        $user = Auth::user();
        return view('producto', array(
          'producto'  => $producto,
          'id' => $user->id
        ));
      }
    }

    public function postProducto(Request $req){

      $user = Auth::user();

      $image = $req->file('image');
      if($image){
        $image_path = $image->getClientOriginalName();
        \Storage::disk('productos')->put($user->id.'_'.$image_path, \File::get($image));
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
        'Usuario_id'                  => $user->id
      ));

      return redirect()->action('MisProductosController@getIndex');
    }

    public function getGuardarProducto(){
      return view('formularios.producto');
    }

    public function getImgage($archivo){
      $file = Storage::disk('productos')->get($archivo);
      return new Response($file, 200);
    }

    public function getBorrarProducto($id){
      $producto = DB::table('productos')->where('id', $id)->delete();
      return redirect()->action('MisProductosController@getIndex')->with('status', 'Producto eliminado correctamente');
    }

    public function postActualizarProducto($id, Request $req){

      $user = Auth::user();

      $image = $req->file('image');
      if($image){
        $image_path = $image->getClientOriginalName();
        \Storage::disk('productos')->put($user->id.'_'.$image_path, \File::get($image));
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

      return redirect()->action('MisProductosController@getIndex')->with('status', 'Producto actualizado correctamente');
    }

    public function getActualizarProducto($id){
      $producto = DB::table('productos')->where('id', $id)->first();
      return view('formularios.producto', array(
        'producto' => $producto
      ));
    }
}
