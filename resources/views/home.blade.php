@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Bienvenido a productos OFINEC!<br><br>
                    Pruebe <a href="{{ url('/productos-prueba') }}">aquí</a> como gestionar sus productos.                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
