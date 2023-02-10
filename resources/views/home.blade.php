@extends('adminlte::page')

@section('title')

@section('content_header')
  {{--
    <h1>{{session('gestion_id')}}</h1>
    <h1>monto {{session('monto_caja_global')}}</h1>
    <h1>ingreso {{session('monto_ingreso_global')}}</h1>
    <h1>egresos {{session('monto_egreso_global')}}</h1>
  --}}
  <h1></h1> 
@stop

@section('content')
<div class="row">
  <div class="col-sm-3">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{$cant_productos}}</h3>

        <p>Productos</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="{{route('producto.catalogo')}}" class="small-box-footer">Ver Catalogo de Productos <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-sm-3">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3 id="ingreso_global" name="ingreso_global" >0</h3>

        <p>INGRESOS</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="{{route('ingreso.index')}}" class="small-box-footer">Ver Ingresos<i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-sm-3">
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3 id="egreso_global" name="egreso_global" >0</h3>

        <p>EGRESOS</p>
      </div>
      <div class="icon">
        <i class="fas fa-arrow-circle-right"></i>
      </div>
      <a href="{{route('egreso.index')}}" class="small-box-footer">Ver Egresos<i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-sm-3">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>65</h3>

        <p>Unique Visitors</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
<div class="text-center">
  
  <img src="{{asset('imagenes/inicio.jpg')}}" class="img-fluid img-bordered" alt="no existe">
</div>

@stop



@section('js')

<script>
  calcular_gestion_caja();
</script>
        
@stop