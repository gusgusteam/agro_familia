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
                        <h1>Alamacenes eliminados</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('almacen.index') }}">Almacenes</a></li>
                            <li class="breadcrumb-item active">Almacenes eliminadas</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-secondary card-outline">

                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-sm table-hover table-striped ">
                                    <thead>
                                        <tr>
                                            <th width="5%"> id </th>
                                            <th> Sigla </th>
                                            <th> Capacidad </th>
                                            <th width="4%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($almacenes as $almacen)
                                        <tr>
                                            <td>{{$almacen->id}}</td>
                                            <td>{{$almacen->sigla}}</td>
                                            <td>{{$almacen->capacidad}}</td>
                                            <td class="text-center">
                                                <a href="#" data-href="{{route('almacen.restore',$almacen->id)}}" rel="tooltip" title="Restaurar" data-toggle="modal" data-target="#modal-confirma" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-alt-circle-up"></i></a>
                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="modal-confirma" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Restaurar Registro</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Desea Restaurar este registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-danger btn-ok btn-sm">Confirmar</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
