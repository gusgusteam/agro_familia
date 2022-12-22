@extends('layouts.base')

@section('content')

{{-- INICIO DEL CUERPO --}}

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6 mb-0">
            <h1>Crear Almacén</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{route('almacen.index')}}">Almacenes</a></li>
              <li class="breadcrumb-item active">Crear Almacén</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="POST" action="{{route('almacen.store')}}" autocomplete="off" class="needs-validation" novalidate>
              @method('POST')
              @csrf
                <div class="card card-secondary card-outline">
                    <div class="card-body">

                        <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                <label for="sigla">Sigla</label> 
                                <input class="form-control" id="sigla" name="sigla" type="text" value="{{old('sigla')}}"placeholder="ingrese una sigla " pattern=".*\S+.*" autofocus required />
                                <div class="invalid-feedback">Introduzca la sigla.</div>
                                @error('nombre')
                                <small class="text-danger"> {{$message}}</small>
                                @enderror
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                <label for="capacidad">Capacidad</label> 
                                <input class="form-control" id="capacidad" name="capacidad" type="text" pattern=".*\S+.*" placeholder="ingrese la capacidad "value="{{old('capacidad')}}" required />
                                <div class="invalid-feedback">Por favor, coloque una capacidad.</div>
                                @error('descripcion')
                                <small class="text-danger"> {{$message}}</small>
                                @enderror
                              </div>
                          </div>
                      </div>

                          <div class="d-flex justify-content-end">
                              <div>
                                <button type="submit" class= "btn btn-success btn-sm">Guardar</button> 
                                <a href="{{route('almacen.index')}}" class= "btn btn-secondary btn-sm">Regresar</a>  
                              </div>
                          </div>

                    </div><!--/body card-->

                </div><!--/CARD FIN-->
            </form>

        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection