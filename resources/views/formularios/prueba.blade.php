@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if(!isset($producto))
                      Agregar producto de prueba
                    @else
                      Actualizar producto de prueba
                    @endif
                    <a href="{{ url('productos-prueba') }}">
                      <span class="badge pull-right" data-toggle="tooltip" data-placement="top" title="Regresar"><i class="fa fa-arrow-left"></i></span>
                    </a>
                </div>
                <div class="panel-body">
                  <form
                    action="{{ isset($producto) ? url('/productos-prueba/actualizar-producto/'.$producto->id) : url('/productos-prueba/producto') }}"
                    method="POST"
                    class="form-horizontal"
                    enctype="multipart/form-data"
                    >
                    {!! csrf_field() !!}
                    <div class="form-group">
                      <label for="input1" class="col-sm-2 control-label">Referencia</label>
                      <div class="col-sm-10">
                        <input name="ReferenciaProducto" value="{{ isset($producto) ? $producto->ReferenciaProducto : '' }}" type="number" class="form-control" id="input1" placeholder="Código de referencia del producto">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input2" class="col-sm-2 control-label">Nombre</label>
                      <div class="col-sm-10">
                        <input name="NombreProducto" value="{{ isset($producto) ? $producto->NombreProducto : '' }}" type="text" class="form-control" id="input2" placeholder="Nombre del producto">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input7" class="col-sm-2 control-label">Nombre</label>
                      <div class="col-sm-10">
                        <input name="image" value="{{ isset($producto) ? $producto->FotoProducto : '' }}" type="file" class="form-control" id="input7" placeholder="Seleccione una imagen">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input3" class="col-sm-2 control-label">Peso</label>
                      <div class="col-sm-10">
                        <input name="Peso" value="{{ isset($producto) ? $producto->Peso : '' }}" type="number" class="form-control" id="input3" placeholder="Peso en libras del producto">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input4" class="col-sm-2 control-label">Precio</label>
                      <div class="col-sm-10 input-group" style="padding-right: 15px; padding-left: 15px;">
                        <div class="input-group-addon">$</div>
                        <input name="Precio" value="{{ isset($producto) ? $producto->Precio : '' }}" type="number" class="form-control" id="input4" placeholder="Valor de venta del producto">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input5" class="col-sm-2 control-label">Cantidad</label>
                      <div class="col-sm-10">
                        <input name="Cantidad" value="{{ isset($producto) ? $producto->Cantidad : '' }}" type="number" class="form-control" id="input5" placeholder="Cantidad total en inventario del producto">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input6" class="col-sm-2 control-label">Categoría</label>
                      <div class="col-sm-10">
                        <select name="Categoria" class="form-control" id="input6" placeholder="Seleccione una categoría">
                            <option value="" {{ isset($producto) ? $producto->Categoria=='' || $producto->Categoria==NULL ? 'selected' : '' : 'selected' }} disabled>Seleccione una categoría</option>
                            <option value="líquidos" {{ isset($producto) ? $producto->Categoria=='líquidos' ? 'selected' : '' : '' }}>Líquidos</option>
                            <option value="granos" {{ isset($producto) ? $producto->Categoria=='granos' ? 'selected' : '' : '' }}>Granos</option>
                            <option value="verduras" {{ isset($producto) ? $producto->Categoria=='verduras' ? 'selected' : '' : '' }}>Verduras</option>
                        </select>
                      </div>
                    </div>
                    @if(isset($producto))
                      <div class="form-group">
                        <label for="input7" class="col-sm-2 control-label">Estado</label>
                        <div class="col-sm-10">
                          <select name="Estado" class="form-control" id="input7" placeholder="Seleccione un estado">
                              <option value="" {{ isset($producto) ? $producto->Estado=='' || $producto->Estado==NULL ? 'selected' : '' : 'selected' }} disabled>Seleccione un estado</option>
                              <option value="activo" {{ isset($producto) ? $producto->Estado=='activo' ? 'selected' : '' : '' }}>Activo</option>
                              <option value="inactivo" {{ isset($producto) ? $producto->Estado=='inactivo' ? 'selected' : '' : '' }}>Inactivo</option>
                          </select>
                        </div>
                      </div>
                    @endif
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">
                          Registrar
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
