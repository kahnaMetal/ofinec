@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado de productos
                    <a href=" {{ url('home') }} ">
                      <span class="badge pull-right" data-toggle="tooltip" data-placement="top" title="Regresar"><i class="fa fa-arrow-left"></i></span>
                    </a>
                </div>
                <div class="panel-body">
                  <a class="pull-right" href="{{ url('formulario-producto') }}">Agregar Nuevo Producto</a><hr />
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
                            <a href="{{ url('mis-productos/producto/'.$producto->id) }}">
                              <span class="label label-primary pull-right" data-toggle="tooltip" data-placement="top" title="Ver detalle">
                                <i class="fa fa-eye"></i>
                              </span>
                            </a>
                            <span class="pull-right">&nbsp;</span>
                            <a href="{{ url('mis-productos/actualizar-producto/'.$producto->id) }}">
                              <span class="label label-warning pull-right" data-toggle="tooltip" data-placement="top" title="Editar">
                                <i class="fa fa-pencil"></i>
                              </span>
                            </a>
                            <span class="pull-right">&nbsp;</span>
                            <a href="{{ url('mis-productos/borrar-producto/'.$producto->id) }}">
                              <span class="label label-danger pull-right" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                <i class="fa fa-times"></i>
                              </span>
                            </a>
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
