@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Gestion</h1>
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
            <li class="nav-item"><a class="nav-link active"   href="#Gestion"  data-toggle="tab"><i class="fas fa-user"></i>&nbsp;&nbsp;Gestion</a></li>
            <li class="nav-item"><a class="nav-link"    onclick="limpiarFormulario()" href="#GestionAgregar" data-toggle="tab"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a></li>
            <li class="nav-item"><a class="nav-link"    href="#GestionEliminados" data-toggle="tab"><i class="far fa-trash-alt"></i>&nbsp;&nbsp;Eliminados</a></li>             
          </ul>
        </div> 
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="Gestion">     
                <table id="example1" class="table table-responsive-xl table-bordered table-sm table-hover table-striped"  >
                    <thead>
                        <tr>  
                          <th width="4%"> id </th>
                          <th>Gestion-tiempo</th>
                          <th>Descripcion</th>
                          <th>Fecha Inicial</th>
                          <th>Fecha Final</th>
                          <th>Estado</th>
                          <th width="7%">Acción</th>
                        </tr>
                    </thead>  
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            <div class="tab-pane" id="GestionEliminados">
                <table id="example2"  class="table table-responsive-xl table-bordered table-sm table-hover table-striped"  >
                    <thead>
                      <tr>  
                        <th width="4%"> id </th>
                        <th>Gestion-tiempo</th>
                        <th>Descripcion</th>
                        <th>Fecha Inicial</th>
                        <th>Fecha Final</th>
                        <th width="5%">Acción</th>
                      </tr>
                    </thead>  
                    <tfoot>
                    </tfoot>
                </table>  
            </div>
            <div class="tab-pane" id="GestionAgregar">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="fecha_inicial">Fecha Inicial</label>
                    <br> 
                    <span class="badge bg-primary">{{date('Y-m-d')}}</span>
                  </div>
                </div>
              </div>
              <form id="miform" method="POST" enctype="multipart/form-data"  autocomplete="off" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="gestion">Gestion tiempo</label> 
                            <input class="form-control" id="gestion" name="gestion" type="text" placeholder="ingrese un nombre de la gestion "  required />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="descripcion">Descripcion</label> 
                            <input class="form-control" id="descripcion" name="descripcion" type="text" placeholder="todos los cultivos a senbrar ? "  required />
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
            <h5 class="modal-title" id="exampleModalLabel">Editar Gestion</h5>
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
                    <label for="gestionM">Gestion-tiempo</label>
                    <input type="text" class="form-control" name="gestionM" id="gestionM" >
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
                    <label for="fecha_inicialM">Fecha Inicio</label>
                    <input type="text" class="form-control" name="fecha_inicialM" id="fecha_inicialM" disabled >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="fecha_finalM">Fecha De Cierre</label>
                    <input type="text" class="form-control" name="fecha_finalM" id="fecha_finalM"  disabled >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="estadoM">Estado</label>
                    <select class="form-control"  id="estadoM" name="estadoM" required>
                      <option disabled value="">Seleccionar un estado</option>
                    </select>
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
  Activo('#example1'); // con que index va iniciar
  Inactivo('#example2');
  ////////
  function Activo(tabla){
    $(document).ready(function() {     
        $(tabla).DataTable({ 
          destroy: true,
          retrieve: true,
          serverSide: true,
          autoWidth: false,
          responsive: true,
          cache: false,
          ajax: "{{route('gestion.DatosServerSideActivo')}}",
          dataType: 'json',
          type: "POST",
          columns: [
              {
                data: 'id',
              },
              {
                data: 'nombre',
              },
              {
                data: 'descripcion',
              },
              {
                data: 'fecha_inicial',
              },
              {
                data: 'fecha_final',
              },
              {
                data: 'estado',
              },
              {
                data: 'actions',
                searchable: false,
                orderable: false,
              }
          ],
        })
    })
  }
  /////////
  function Inactivo(tabla){
    $(document).ready(function() {     
        $(tabla).DataTable({ 
          destroy: true,
          retrieve: true,
          serverSide: true,
          autoWidth: false,
          responsive: true,
          cache: false,
          ajax: "{{route('gestion.DatosServerSideInactivo')}}",
          dataType: 'json',
          type: "POST",
          columns: [
              {
                data: 'id',
              },
              {
                data: 'nombre',
              },
              {
                data: 'descripcion',
              },
              {
                data: 'fecha_inicial',
              },
              {
                data: 'fecha_final',
              },
              {
                data: 'actions',
                searchable: false,
                orderable: false,
              }
          ],
        })
    })
  }
  /////////
  function recarga(){
    $('#example1').DataTable().ajax.reload();
    $('#example2').DataTable().ajax.reload(); 
  }

   //guardar 
   $('#miform').submit(function(e){
      e.preventDefault();
      var link="{{route('gestion.store')}}";
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
        url:"{{asset('')}}"+"gestion/buscar/"+id, dataType:'json',
        success: function(resultado){
          $("#id_edit").val(resultado.datos.id);
          $("#gestionM").val(resultado.datos.nombre);
          $("#descripcionM").val(resultado.datos.descripcion);
          $("#fecha_inicialM").val(resultado.datos.fecha_inicial);
          $('#fecha_finalM').val("no finalizo la campaña");
          if(resultado.datos.fecha_final){
            $("#fecha_finalM").val(resultado.datos.fecha_final);
          }
          $('#ModalEditar').modal('show'); // abrir el modal
          ////////////colocar el array al selectd ////////////////////
          $('#estadoM').empty(); // limpiar antes de sobreescribir
          var $sw=resultado.datos.estado;
          $('#estadoM').append($('<option  />', {
          text: 'Campaña en curso',
          value: 0,
          }));
          $('#estadoM').append($('<option  />', {
          text: 'Campaña en finalizada',
          value: 1,
          }));
          $('#estadoM').append($('<option  />', {
          text: 'Campaña en observacion',
          value: -1,
          }));
             
        }
    });         
  }
  //ACTUALIZAR UN REGISTRO
  $('#FormEdicion').submit(function(e){
      e.preventDefault();
      var id=$("#id_edit").val();
      var link="{{asset('')}}"+"gestion/update/"+id;
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#FormEdicion')[0]),   
          success:function(response){
              if(response){
                  toastr.success('El registro fue actualizado correctamente.', 'Actualizar Registro', {timeOut:3000})  
                  $('#ModalEditar').modal('hide'); // salir modal
                  recarga();       
              }
          }
      })
    
  });
  //

  function Eliminar(id){ // modal
    $("#id_delete").val(id);
    $('#ModalEliminar').modal('show');
  }
  // ELIMINAR UN REGISTRO
  $('#Delete').click(function(){
    var id = $("#id_delete").val();
    var link="{{asset('')}}"+"gestion/destroy/"+id;
      $.ajax({
          url: link,
          type: "GET",
          cache: false,
          async: false,
          success:function(resultado){
            toastr.success('El registro fue eliminado correctamente.', 'Eliminar Registro', {timeOut:3000})           
          }
      })
    $('#ModalEliminar').modal('hide'); // salir modal
    recarga();
  });
  //

  function Restaurar(id){ // modal
    $("#id_restore").val(id);
    $('#ModalRestaurar').modal('show');
  }
  // ELIMINAR UN REGISTRO
  $('#Restore').click(function(){
    var id = $("#id_restore").val();
    var link="{{asset('')}}"+"gestion/restore/"+id;
      $.ajax({
          url: link,
          type: "GET",
          cache: false,
          async: false,
          success:function(resultado){
            toastr.success('El registro fue restaurado correctamente.', 'Restaurar Registro', {timeOut:3000})           
          }
      })
    $('#ModalRestaurar').modal('hide'); // salir modal
    recarga();
  });
  //
  </script>
@stop