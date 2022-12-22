@extends('adminlte::page')
@section('title')
@section('content_header')
    <h1>Reportes</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header p-2">
             {{-- <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" onclick="recarga()"  href="#Roles"  data-toggle="tab"><i class="fas fa-user"></i>&nbsp;&nbsp;Roles</a></li>
                <li class="nav-item"><a class="nav-link"  onclick="limpiarFormulario()" href="#RolesAgregar" data-toggle="tab"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a></li>
                <li class="nav-item"><a class="nav-link"  onclick="recarga()"  href="#RolesEliminados" data-toggle="tab"><i class="far fa-trash-alt"></i>&nbsp;&nbsp;Eliminados</a></li>             
              </ul>
              --}}
            </div> 
           
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-4">
                    <div class="col mb-4">
                        <div class="card card-outline card-success">
                            <form action="{{route('reporte.usuario')}}" method="POST">
                                @csrf
                                <div class="card-header text-sm text-left">
                                    <h5 class="card-title">Reporte Usuario</h5>
                                    <div class="text-right">
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i> PDF</button>
                                    </div>   
                                </div>
                                <div class="card-body">
                                    <select name="usuario_option" id="usuario_option" >
                                        <option selected value="1">Activos</option>
                                        <option value="0">Inactivos</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col mb-4">
                      <div class="card card-outline card-success">
                        <form action="{{route('reporte.rol')}}" method="POST">
                            @csrf
                            <div class="card-header text-sm text-left">
                                <h5 class="card-title">Reporte Roles</h5>
                                <div class="text-right">
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i> PDF</button>
                                </div>   
                            </div>
                            <div class="card-body">
                                <select name="rol_option" id="rol_option" >
                                    <option selected value="1">Activos</option>
                                    <option value="0">Inactivos</option>
                                </select>
                            </div>
                        </form>
                      </div>
                    </div>
                    <div class="col mb-4">
                      <div class="card card-outline card-success">
                        <div class="card-header text-sm text-left">
                            <h5 class="card-title">Reporte Ingresos</h5>
                        </div>
                        <div class="card-body">
                          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                        </div>
                      </div>
                    </div>
                    <div class="col mb-4">
                      <div class="card card-outline card-success">
                        <div class="card-header text-sm text-left">
                            <h5 class="card-title">Reporte Egresos</h5>
                        </div>
                        <div class="card-body">
                          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                      </div>
                    </div>
                    <div class="col mb-4">
                        <div class="card card-outline card-success">
                          <div class="card-header text-sm text-left">
                            <h5 class="card-title">Reporte Inventario</h5>
                          </div>
                          <div class="card-body">
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                          </div>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="card card-outline card-success">
                          <div class="card-header text-sm text-left">
                            <h5 class="card-title">Reporte Ventas</h5>
                          </div>
                          <div class="card-body">
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                          </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
@stop

@section('css')
   
@stop


@section('plugins.Datatables', true)
@section('plugins.Toastr', true)
@section('js')

@stop