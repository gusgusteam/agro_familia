@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="container-fluid mt-2 mb-5">
    <div class="products">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row g-3">
                    @foreach ($productos as $producto)
                        @php
                           $imagen='imagenes/productos/'.$producto->id.'.png'; 
                           if (!file_exists($imagen)) { // existe la imagen con el nombre del id empleado
                           $imagen = "imagenes/productos/150x150.png";
                           }
                           $url=asset($imagen.'?'.time());
                        @endphp
                        <div class="col-sm-3">
                            <div class="card"> <img src="{{$url}}" class="card-img-top">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between"> <span class="font-weight-bold">{{$producto->nombre}}</span> <span class="font-weight-bold">${{$producto->precio_venta}}</span> </div>
                                    <p class="card-text mb-1 mt-1">{{$producto->descripcion}}</p>
                                    <div class="d-flex align-items-center flex-row"> <img src="https://i.imgur.com/e9VnSng.png" width="20"> <span class="guarantee">{{$producto->nombre_tipo}}</span> </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="text-right buttons"> 
                                        <button class="btn btn-sm btn-success">Detalles</button> 
                                        <button class="btn btn-sm btn-warning">Add Cart</button> 
                                    </div>
                                </div>
                            </div>
                        </div>  
                    @endforeach  
                </div>
            </div>
        </div>
    </div>
</div>

@stop



@section('js')

        
@stop