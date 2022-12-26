@extends('adminlte::page')
@section('title')
@section('content_header')
    <h1>Reportes</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="card">
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
                        <form action="{{route('reporte.caja')}}" method="POST">
                          @csrf
                          <div class="card-header text-sm text-left">
                              <h5 class="card-title">Reporte Caja</h5>
                              <div class="text-right">
                                  <button class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i> PDF</button>
                              </div>   
                          </div>
                          <div class="card-body">
                            <label for="id_caja">Seleccione una caja</label>
                            <select class="select2 select2-hidden-accessible" id="id_caja" name="id_caja[]" multiple="multiple" data-placeholder="Seleccione a las personas vinculadas" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true"> 
                              @foreach ($cajas as $caja)
                                <option  value="{{$caja->id}}">{{$caja->nombre}}</option>
                              @endforeach
                            </select> 
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="col mb-4">
                      <div class="card card-outline card-success">
                        <form action="#" method="POST">
                          @csrf
                          <div class="card-header text-sm text-left">
                              <h5 class="card-title">Reporte Gestion</h5>
                              <div class="text-right">
                                  <button class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i> PDF</button>
                              </div>   
                          </div>
                          <div class="card-body">
                            <label for="id_gestion">Seleccione una gestion</label>
                            <select class="select2 select2-hidden-accessible" id="id_gestion" name="id_gestion[]" multiple="multiple" data-placeholder="Seleccione las gestiones" style="width: 100%;" data-select2-id="8" tabindex="-1" aria-hidden="true"> 
                              @foreach ($gestiones as $gestion)
                                @if($gestion->estado==0)
                                  @php($icono='<span class="badge bg-success">en curso</span>')
                                @endif
                                @if($gestion->estado==1)
                                  @php($icono='<span class="badge bg-danger">finalizado</span>')
                                @endif
                                @if($gestion->estado==-1)
                                  @php($icono='<span class="badge bg-warning">obserbaciones</span>')
                                @endif
                                <option  value="{{$gestion->id}}">{{$gestion->nombre}} {{$icono}} </option>
                              @endforeach
                            </select> 
                          </div>
                        </form>
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
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>

@stop