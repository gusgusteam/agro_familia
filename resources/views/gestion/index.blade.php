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
<ul class="nav nav-pills nav-tabs mb-3 justify-content-center">
  <li class="nav-item"><a class="nav-link active"   href="#Gestion"  data-toggle="tab"><i class="fas fa-user"></i>&nbsp;&nbsp;Gestion</a></li>
  <li class="nav-item"><a class="nav-link"    onclick="limpiarFormulario()" href="#GestionAgregar" data-toggle="tab"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a></li>
  <li class="nav-item"><a class="nav-link"    href="#GestionEliminados" data-toggle="tab"><i class="far fa-trash-alt"></i>&nbsp;&nbsp;Eliminados</a></li>             
</ul>
<div class="tab-content">
  <div class="active tab-pane" id="Gestion"> 
    <div class="card {{ config('adminlte.classes_index', '') }}">
      <div class="card-header">
      <h3 class="card-title {{ config('adminlte.classes_index_header', '') }} ">LISTA DE GESTION</h3>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-responsive-xl table-bordered table-sm table-hover table-striped"  >
            <thead>
                <tr>  
                  <th width="15%">Gestion-tiempo</th>
                  <th width="35%">Descripcion</th>
                  <th width="10%">Fecha Inicial</th>
                  <th width="15%">Fecha Final</th>
                  <th width="10%">Estado Actual</th>
                  <th width="10%">Acción</th>
                </tr>
            </thead>  
            <tfoot>
            </tfoot>
        </table>
      </div>
    </div>
  </div>
  <div class="tab-pane" id="GestionEliminados"> 
    <div class="card {{ config('adminlte.classes_index', '') }}">
      <div class="card-header">
      <h3 class="card-title {{ config('adminlte.classes_index_header', '') }} ">LISTA DE GESTION</h3>
      </div>
      <div class="card-body">
        <table id="example2" class="table table-responsive-xl table-bordered table-sm table-hover table-striped"  >
            <thead>
                <tr>  
                  <th width="15%">Gestion-tiempo</th>
                  <th width="35%">Descripcion</th>
                  <th width="10%">Fecha Inicial</th>
                  <th width="15%">Fecha Final</th>
                  <th width="10%">Estado Actual</th>
                  <th width="10%">Acción</th>
                </tr>
            </thead>  
            <tfoot>
            </tfoot>
        </table>
      </div>
    </div>
  </div>
  <div class="tab-pane" id="GestionAgregar">
    <div class="card {{ config('adminlte.classes_index', '') }}">
      <div class="card-header">
      <h3 class="card-title  {{ config('adminlte.classes_index_header', '') }}">AGREGAR GESTION</h3>
      </div>
      <form  id="miform" name="miform" method="POST" novalidate="novalidate">
          @csrf
          <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="fecha_inicial">Fecha Inicial</label>
                    <br> 
                    <span class="badge bg-primary">{{date('Y-m-d')}}</span>
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="gestion">Gestion tiempo</label>
                          <input type="text" name="gestion" class="form-control" id="gestion" placeholder="ingrese la gestion ejem: 1-2000" aria-describedby="gestion-error" aria-invalid="true" >
                          <span  id="gestion-error" class="error invalid-feedback" style="display: none;"></span>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="descripcion">Descripcion</label>
                          <textarea type="text" name="descripcion" class="form-control" id="descripcion" placeholder="ingrese la descripcion" aria-describedby="descripcion-error" aria-invalid="true"></textarea>
                          <span id="descripcion-error" class="error invalid-feedback" style="display: none;"></span>
                      </div>
                  </div>
              </div>                 
          </div>
          <div class="card-footer">
              <button type="submit" class="btn btn-success">Guardar</button>
          </div>
      </form>
  </div>
</div>

<div class="modal fade" id="modal-editar-gestion" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="card {{ config('adminlte.classes_modal', '') }}">
          <div class="card-header">
          <h3 class="card-title  {{ config('adminlte.classes_modal_header', '') }}">Datos Actuales</h3>
          </div>
          <form  id="miform_editar_gestion" name="miform_editar_gestion" method="POST" novalidate="novalidate">
              @csrf
              <input type="hidden" name="id_modal_gestion" id="id_modal_gestion">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="gestion_modal_gestion">Gestion tiempo</label>
                          <input type="text" name="gestion_modal_gestion" class="form-control" id="gestion_modal_gestion" placeholder="ingrese la gestion ejem: 1-2000" aria-describedby="gestion_modal_gestion-error" aria-invalid="true" >
                          <span  id="gestion_modal_gestion-error" class="error invalid-feedback" style="display: none;"></span>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="descripcion_modal_gestion">Descripcion</label>
                          <textarea type="text" name="descripcion_modal_gestion" class="form-control" id="descripcion_modal_gestion" placeholder="ingrese la descripcion" aria-describedby="descripcion_modal_gestion-error" aria-invalid="true"></textarea>
                          <span id="descripcion_modal_gestion-error" class="error invalid-feedback" style="display: none;"></span>
                      </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success">Actualizar</button>
              </div>
          </form>
      </div>
    </div>
  </div>
  <!-- /.modal-dialog -->
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
              {data: 'nombre',orderable: false},
              {data: 'descripcion',orderable: false},
              {data: 'fecha_inicial'},
              {data: 'fecha_final'},
              {data: 'estado'},
              {data: 'actions',searchable: false,orderable: false}
          ]
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
            {data: 'nombre',orderable: false},
            {data: 'descripcion',orderable: false},
            {data: 'fecha_inicial'},
            {data: 'fecha_final'},
            {data: 'estado'},
            {data: 'actions',searchable: false,orderable: false}
          ]
        })
    })
  }
  /////////
  function recarga(){
    $('#example1').DataTable().ajax.reload();
    $('#example2').DataTable().ajax.reload(); 
  };
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
               // toastr.error(response.mensaje, 'Guardar Registro', {timeOut:7000});
                toastr.error('revice sus errores por favor', 'Guardar Registro', {timeOut:7000});
               }else{
                  toastr.success('El registro fue guardado correctamente.', 'Guardar Registro', {timeOut:3000}) 
                  limpiarFormulario();
                  removeClass(); 
                  recarga(); 
               }
          }
    })
  });

  function Modificar(id){
    $.ajax({
        url:"{{asset('')}}"+"gestion/buscar/"+id, dataType:'json',
        success: function(resultado){
          removeClassEditarGestion();
          $("#id_modal_gestion").val(resultado.datos.id);
          $("#gestion_modal_gestion").val(resultado.datos.nombre);
          $("#descripcion_modal_gestion").val(resultado.datos.descripcion);
          $('#modal-editar-gestion').modal('show'); // abrir el modal
          ////////////colocar el array al selectd ////////////////////
          /*
          if(resultado.datos.fecha_final){
            $("#fecha_finalM").val(resultado.datos.fecha_final);
          }
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
          */
             
        }
    });         
  }
  //ACTUALIZAR UN REGISTRO
  $('#miform_editar_gestion').submit(function(e){
      e.preventDefault();
      var id=$("#id_modal_gestion").val();
      var link="{{asset('')}}"+"gestion/update/"+id;
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#miform_editar_gestion')[0]),   
          success:function(response){
              if(response.error==1){
               // toastr.error(response.mensaje, 'Actualizar Registro', {timeOut:3000}) 
                toastr.error('revice sus errores por favor', 'Guardar Registro', {timeOut:7000})
            }else{
                toastr.success('El registro fue actualizado correctamente.', 'Actualizar Registro', {timeOut:3000});
                recarga(); 
                $('#modal-editar-gestion').modal('hide'); // salir modal         
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
            if(resultado.error==1){
              toastr.error(resultado.mensaje, 'Eliminar Registro', {timeOut:3000});
            }else{
              recarga();
              toastr.success('El registro fue eliminado correctamente.', 'Eliminar Registro', {timeOut:3000});
            }  
            $('#ModalEliminar').modal('hide'); // salir modal        
          }
      })
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

  $('#miform').validate({
        rules: {
          gestion: {
            required: true,
          },
          descripcion: {
            required: true,
          }
        },
        messages: {
          gestion: {
            required: "Por favor, introduzca su nombre de la gestion",
          },
          descripcion: {
            required: "Por favor, introduzca su descripcion ",
          }
        },
        errorElement: 'span',
        
        errorPlacement: function (error, element) {
           error.addClass('invalid-feedback');
           element.closest('.form-group').append(error);  
        },
        
        highlight: function (element, errorClass, validClass) {
         $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
         $(element).removeClass('is-invalid').addClass( "is-valid" );
        }                 
    });

    $('#miform_editar_gestion').validate({
        rules: {
          gestion_modal_gestion: {
            required: true,
          },
          descripcion_modal_gestion: {
            required: true,
          }
        },
        messages: {
          gestion_modal_gestion: {
            required: "Por favor, introduzca su nombre de la gestion ",
          },
          descripcion_modal_gestion: {
            required: "Por favor, introduzca su descripcion ",
          }
        },
        errorElement: 'span',
        
        errorPlacement: function (error, element) {
           error.addClass('invalid-feedback');
           element.closest('.form-group').append(error);  
        },
        
        highlight: function (element, errorClass, validClass) {
         $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
         $(element).removeClass('is-invalid').addClass( "is-valid" );
        }               
      
    });

    function removeClass(){
      $("#gestion").removeClass(["is-valid","is-invalid"]);
      $("#descripcion").removeClass(["is-valid","is-invalid"]);
    };
    function removeClassEditarGestion(){
      $("#gestion_modal_gestion").removeClass(["is-valid","is-invalid"]);
      $("#descripcion_modal_gestion").removeClass(["is-valid","is-invalid"]);
    }
  </script>
@stop