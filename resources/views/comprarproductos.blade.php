@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado de productos para comprar
                    <a href=" {{ url('home') }} ">
                      <span class="badge pull-right" data-toggle="tooltip" data-placement="top" title="Regresar"><i class="fa fa-arrow-left"></i></span>
                    </a>
                </div>
                <div class="panel-body">
                  @if(session('status'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      {{session('status')}}
                    </div>
                  @endif
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Producto</th>
                        <th>Referencia</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Proveedor</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($productos as $producto)
                      @if(isset($producto->id))
                        <tr>
                          <td>
                            {{ $producto->NombreProducto }}
                          </td>
                          <td>
                            {{ $producto->ReferenciaProducto }}
                          </td>
                          <td>
                            {{ $producto->Precio }}
                          </td>
                          <td>
                            {{ $producto->Cantidad<1 ? 0 : $producto->Cantidad }}
                          </td>
                          <td>
                            {{ $producto->ReferenciaProducto }}
                          </td>
                          <td>
                            <a href="{{ url('comprar-productos/producto/'.$producto->id) }}">
                              <span class="label label-primary pull-right" data-toggle="tooltip" data-placement="top" title="Ver detalle">
                                <i class="fa fa-eye"></i>
                              </span>
                            </a>
                            @if($producto->Cantidad>0)
                            <span class="pull-right">&nbsp;</span>
                            <a href="{{ url('comprar-productos/comprar/'.$producto->id) }}">
                              <span class="label label-success pull-right" data-toggle="tooltip" data-placement="top" title="Comprar">
                                <i class="fa fa-shopping-cart"></i>
                              </span>
                            </a>
                            @endif
                            <span>&nbsp;</span>
                          </td>
                        </tr>
                      @endif()
                    @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
