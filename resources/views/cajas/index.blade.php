@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Cajas</h1>
@stop

  <style>
    .intermitente{
      border: 1px solid green;
      padding: 0% 0%;
      box-shadow: 0px 0px 10px;
      color: green;
      animation: infinite resplandorAnimation 2s;
    }
    @keyframes resplandorAnimation {
      0%,100%{
        box-shadow: 0px 0px 20px;
      }
      50%{
      box-shadow: 0px 0px 0px;
      }
    }
  </style>

@section('content')
    <div class="container-fluid">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active"   href="#Caja"  data-toggle="tab"><i class="fas fa-user"></i>&nbsp;&nbsp;Cajas</a></li>
            <li class="nav-item"><a class="nav-link"    onclick="limpiarFormulario()" href="#CajaAgregar" data-toggle="tab"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a></li>
            <li class="nav-item"><a class="nav-link"    href="#CajaEliminados" data-toggle="tab"><i class="far fa-trash-alt"></i>&nbsp;&nbsp;Eliminados</a></li>             
          </ul>
        </div> 
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="Caja">     
                <table id="example1" class="table table-responsive-xl table-bordered table-sm table-hover table-striped"  >
                    <thead>
                        <tr>  
                          <th width="4%"> id </th>
                          <th>nombre</th>
                          <th>Descripcion</th>
                          <th>tipo de caja</th>
                          <th>Monto total <span class="badge bg-primary">bs</span></th>
                          <th width="7%">Acción</th>
                        </tr>
                    </thead>  
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            <div class="tab-pane" id="CajaEliminados">
                <table id="example2"  class="table table-responsive-xl table-bordered table-sm table-hover table-striped"  >
                    <thead>
                      <tr>  
                        <th width="4%"> id </th>
                        <th>nombre</th>
                        <th>Descripcion</th>
                        <th>tipo de caja</th>
                        <th>Monto total <span class="badge bg-primary">bs</span></th>
                        <th width="5%">Acción</th>
                      </tr>
                    </thead>  
                    <tfoot>
                    </tfoot>
                </table>  
            </div>
            <div class="tab-pane" id="CajaAgregar">
              
              <form id="miform" method="POST" enctype="multipart/form-data"  autocomplete="off" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="nombre">Nombre</label> 
                            <input class="form-control" id="nombre" name="nombre" type="text" placeholder="ingrese un nombre de la gestion "  required />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="descripcion">Descripcion</label> 
                            <input class="form-control" id="descripcion" name="descripcion" type="text" placeholder="referencia de la caja"  required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="tipo_caja">Tipo Caja</label> 
                            <select class="form-control" name="tipo_caja" id="tipo_caja" >
                                <option value="0">Personal</option>
                                <option value="1">Grupal</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="monto">Monto inicial  <span class="badge bg-primary">bs</span></label> 
                            <input disabled class="form-control" id="monto" name="monto" type="number" value="0.0"  required />
                            </div>
                        </div>
                    </div>
                  
                    <div class="d-flex justify-content-end">
                        <div>
                        <button type="submit" class= "btn btn-success btn-sm">Guardar</button>  
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ModalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header border-bottom-0">
            <h5 class="modal-title" id="exampleModalLabel">Editar Caja</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="FormEdicion">
            @csrf
            <div class="modal-body">
              <input type="hidden" class="form-control" id="id_edit" value="1">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="nombreM">Nombre</label>
                    <input type="text" class="form-control" name="nombreM" id="nombreM" >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="descripcionM">Descripcion</label>
                    <textarea  class="form-control" name="descripcionM" id="descripcionM" > </textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="monto_totalM">Monto total</label>
                    <input type="number" class="form-control" name="monto_totalM" id="monto_totalM" disabled >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="tipo_cajaM">Tipo Caja</label>
                    <input type="text" class="form-control" name="tipo_cajaM" id="tipo_cajaM"  disabled >
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-center">
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

@stop

@section('css')
   {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop


@section('plugins.Datatables', true)
@section('plugins.Toastr', true)
@section('js')


<script>
  Activo('#example1'); 
  Inactivo('#example2');

  function Activo(tabla){   
    $(tabla).DataTable({ 
      destroy: true,
      retrieve: true,
      serverSide: true,
      autoWidth: false,
      responsive: true,
      ajax: "{{route('caja.DatosServerSideActivo')}}",
      dataType: 'json',
      type: "POST",
      columns: [
          {data: 'id'},
          {data: 'nombre'},
          {data: 'descripcion'},
          {data: 'tipo'},
          {data: 'monto_total'},
          {data: 'actions',searchable: false,orderable: false}
      ],
    });
  }

  function Inactivo(tabla){  
    $(tabla).DataTable({ 
      destroy: true,
      retrieve: true,
      serverSide: true,
      autoWidth: false,
      responsive: true,
      ajax: "{{route('caja.DatosServerSideInactivo')}}",
      dataType: 'json',
      type: "POST",
      columns: [
          {data: 'id'},
          {data: 'nombre'},
          {data: 'descripcion'},
          {data: 'tipo'},
          {data: 'monto_total'},
          {data: 'actions',searchable: false,orderable: false}
      ],
    });
  }

  function recarga(){
    $('#example1').DataTable().ajax.reload();
    $('#example2').DataTable().ajax.reload(); 
  }

   //guardar 
   $('#miform').submit(function(e){
      e.preventDefault();
      var link="{{route('caja.store')}}";
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#miform')[0]),    
          success:function(response){
            if (response.error==1){
                toastr.error(response.mensaje, 'Guardar Registro', {timeOut:7000})
               }else{
                  toastr.success('El registro fue guardado correctamente.', 'Guardar Registro', {timeOut:3000}) 
                  recarga();
                  limpiarFormulario();  
               }
          }
      })
  });

  function Modificar(id){
    $.ajax({
        url:"{{asset('')}}"+"caja/buscar/"+id, dataType:'json',
        success: function(resultado){
          $("#id_edit").val(resultado.datos.id);
          $("#nombreM").val(resultado.datos.nombre);
          $("#descripcionM").val(resultado.datos.descripcion);
          $("#monto_totalM").val(resultado.datos.monto_total);
          if(resultado.datos.tipo_caja==0){
            $('#tipo_cajaM').val('Caja Personal');
          }
          if(resultado.datos.tipo_caja==1){
            $('#tipo_cajaM').val('Caja Grupal');
          }
          if(resultado.datos.tipo_caja==-1){
            $('#tipo_cajaM').val('Caja Gestion');
          }
          $('#ModalEditar').modal('show'); // abrir el modal           
        }
    });         
  }
  //ACTUALIZAR UN REGISTRO
  $('#FormEdicion').submit(function(e){
      e.preventDefault();
      var id=$("#id_edit").val();
      var link="{{asset('')}}"+"caja/update/"+id;
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#FormEdicion')[0]),   
          success:function(response){
              if(response){
                  toastr.success('El registro fue actualizado correctamente.', 'Actualizar Registro', {timeOut:3000})
                  recarga();         
              }
          }
      })
    $('#ModalEditar').modal('hide'); // salir modal
   
  });
  //

  function Eliminar(id){ // modal
    $("#id_delete").val(id);
    $('#ModalEliminar').modal('show');
  }
  // ELIMINAR UN REGISTRO
  $('#Delete').click(function(){
    var id = $("#id_delete").val();
    var link="{{asset('')}}"+"caja/destroy/"+id;
      $.ajax({
          url: link,
          type: "GET",
          cache: false,
          async: false,
          success:function(resultado){
            toastr.success('El registro fue eliminado correctamente.', 'Eliminar Registro', {timeOut:3000})  
            recarga();         
          }
      })
    $('#ModalEliminar').modal('hide'); // salir modal
  });
  //

  function Restaurar(id){ // modal
    $("#id_restore").val(id);
    $('#ModalRestaurar').modal('show');
  }
  // ELIMINAR UN REGISTRO
  $('#Restore').click(function(){
    var id = $("#id_restore").val();
    var link="{{asset('')}}"+"caja/restore/"+id ;
      $.ajax({
          url: link,
          type: "GET",
          cache: false,
          async: false,
          success:function(resultado){
            if(resultado.error==1){
              toastr.error(resultado.mensaje, 'Restaurar Registro', {timeOut:3000})   
            }else{
              toastr.success('El registro fue restaurado correctamente.', 'Restaurar Registro', {timeOut:3000})  
              recarga();   
            }        
          }
      })
    $('#ModalRestaurar').modal('hide'); // salir modal
  });
  //
</script>
@stop