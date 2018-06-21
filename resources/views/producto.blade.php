@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Detalle de producto
                    <a href=" {{ ($producto->Usuario_id) == 1 ? url('productos-prueba') : isset($id) ? url('mis-productos') : url('comprar-productos') }} ">
                      <span class="badge pull-right" data-toggle="tooltip" data-placement="top" title="Regresar"><i class="fa fa-arrow-left"></i></span>
                    </a>
                </div>
                <div class="panel-body">
                  <div class="page-header">
                    <div class="row">
                      <div class="col-md-6">
                        <h1>{{$producto->NombreProducto}} <small>{{$producto->ReferenciaProducto}}</small></h1>
                      </div>
                      @if(isset($comprar) && $comprar==TRUE)
                      <div class="col-md-6">
                        <form method="POST" action="{{ url('/comprar-productos/comprar/'.$producto->id) }}">
                          {!! csrf_field() !!}
                          <div class="form-group">
                            <input id="qtyShop" name="qty" value="{{ isset($producto) ? $producto->Cantidad : '' }}" type="number" class="form-control" id="input2" placeholder="Nombre del producto">
                          </div>
                          <div class="form-group">
                            <input id="valorU" name="valorU" value="{{ isset($producto) ? $producto->Precio : 0 }}" type="hidden">
                            <input id="valorT" type="number" value="{{ isset($producto) ? $producto->Precio*$producto->Cantidad : 0 }}" readonly disabled class="form-control" placeholder="Valor Total">
                          </div>
                          <div class="form-group">
                            <button type="submit" class="btn btn-default">
                              <i class="fa fa-shopping-cart"></i> COMPRAR
                            </button>
                          </div>
                        </form>
                      </div>
                      @endif
                    </row>
                  </div>
                  <br><hr><br>
                  <div class="row">
                    <div class="col-md-6">
                      <p><strong>Peso: </stron>{{$producto->Peso}}</p>
                      <p><strong>Precio: </strong>{{$producto->Precio}}</p>
                      <p><strong>Cantidad: </strong>{{$producto->Cantidad<1 ? 0 : $producto->Cantidad}}</p>
                      <p><strong>Categoría: </strong>{{$producto->Categoria}}</p>
                      <p><strong>Estado: </strong><span class="label {{$producto->Estado == 'activo' ? 'label-success' : 'label-warning'}}">{{$producto->Estado}}</span></p>
                    </div>
                    <div class="col-md-6">
                      @if(isset($producto->FotoProducto) && $producto->FotoProducto!='' && $producto->FotoProducto!=NULL)
                        @if(!isset($id))
                          <?php $id = $producto->Usuario_id; ?>
                        @endif
                        <img width="220" src="{{ url('/img-producto/'.$id.'_'.$producto->FotoProducto) }}" class="pull-right img-rounded" alt="{{ url('/img-producto/'.$producto->FotoProducto) }}">
                      @endif
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
