@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Roles</h1>
@stop

@section('content')
<ul class="nav nav-pills nav-tabs mb-3 justify-content-center">
  <li class="nav-item"><a class="nav-link active"   href="#Roles"  data-toggle="tab"><i class="fas fa-user"></i>&nbsp;&nbsp;Roles</a></li>
  <li class="nav-item"><a class="nav-link"  onclick="limpiarFormulario()" href="#RolesAgregar" data-toggle="tab"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a></li>
</ul>
<div class="tab-content">
  <div class="active tab-pane" id="Roles"> 
    <div class="card {{ config('adminlte.classes_index', '') }}">
        <div class="card-header">
        <h3 class="card-title {{ config('adminlte.classes_index_header', '') }} ">LISTA DE EMPLEADOS</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-sm-2">
                    <select  name="filtro" id="filtro" value="" class="form-control form-control-sm" >
                    <option value="0">Roles Inactivos</option>
                    <option value="1">Roles Activos</option>
                    <option selected value="2">Todos los roles</option>
                    </select>
                </div>
            </div>    
            <table id="example1" class="table table-responsive-xl table-bordered table-sm table-hover table-striped"  >
                <thead>
                    <tr>  
                      <th width="30%">Nombre</th>
                      <th width="60%">Descripcion</th>
                      <th width="5%">Estado</th>
                      <th width="5%">Acción</th>
                    </tr>
                </thead>  
                <tfoot>
                </tfoot>
            </table>
        </div>
      </div>
  </div>
  <div class="tab-pane" id="RolesAgregar">
    <div class="card {{ config('adminlte.classes_index', '') }}">
      <div class="card-header">
      <h3 class="card-title  {{ config('adminlte.classes_index_header', '') }}">AGREGAR ROL</h3>
      </div>
      <form  id="miform" name="miform" method="POST" novalidate="novalidate">
          @csrf
          <div class="card-body">
              <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="nombre" >Nombre</label>
                          <input type="text" name="nombre" class="form-control" id="nombre" placeholder="ingrese el nombre" aria-describedby="nombre-error" aria-invalid="true" >
                          <span id="nombre-error" class="error invalid-feedback" style="display: none;"></span>
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
</div>

<div class="modal fade" id="modal-editar-rol" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="card {{ config('adminlte.classes_modal', '') }}">
          <div class="card-header">
          <h3 class="card-title  {{ config('adminlte.classes_modal_header', '') }}">Datos Actuales</h3>
          </div>
          <form  id="miform_editar_rol" name="miform_editar_rol" method="POST" novalidate="novalidate">
              @csrf
              <input type="hidden" name="id_modal_rol" id="id_modal_rol">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="nombre_modal_rol" >Nombre</label>
                          <input type="text" name="nombre_modal_rol" class="form-control" id="nombre_modal_rol" placeholder="ingrese el nombre" aria-describedby="nombre_modal_rol-error" aria-invalid="true" >
                          <span id="nombre_modal_rol-error" class="error invalid-feedback" style="display: none;"></span>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                        <label for="descripcion_modal_rol">Descripcion</label>
                        <textarea type="text" name="descripcion_modal_rol" class="form-control" id="descripcion_modal_rol" placeholder="ingrese la descripcion" aria-describedby="descripcion_modal_rol-error" aria-invalid="true"></textarea>
                        <span id="descripcion_modal_rol-error" class="error invalid-feedback" style="display: none;"></span>
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
  $('#filtro').change(function (e) { 
    if($(this).val()==0){
     // $('#example1').DataTable().search( ':inactivo' ).draw();
     $('#example1').DataTable().column(2).search(': inactivo', true, false, true).draw();
    }
    if($(this).val()==1){
     $('#example1').DataTable().column(2).search(': activo', true, false, true).draw();
    }
    if($(this).val()==2){
     $('#example1').DataTable().column(2).search(':', true, false, true).draw();
    }
  });
  //Inactivo('#example2');
  ////////
  function Activo(tabla){  
    $(tabla).DataTable({ 
      destroy: true,
      retrieve: true,
      serverSide: true,
      autoWidth: false,
      responsive: true,
      cache: false,
      ajax: "{{route('rol.DatosServerSideActivo')}}",
      dataType: 'json',
      type: "POST",
      columns: [
        {data: 'name'},
        {data: 'descripcion'},
        {data: 'estado'},
        {data: 'actions',searchable: false, orderable: false}
      ],
    })
  }
  /////////

  /////////
  function recarga(){
    $('#example1').DataTable().ajax.reload();
    $('#example2').DataTable().ajax.reload(); 
  }

  function Permisos(id){
    $.ajax({
        url:"{{asset('')}}"+"rol/buscar/"+id, dataType:'json',
        success: function(resultado){
          $("#id_edit").val(resultado.id);
          $("#nombreM").val(resultado.name);
          $("#descripcionM").val(resultado.descripcion);
          $('#ModalPermisos').modal('show'); // abrir el modal
        }
    });   
  }

  //guardar 
  $('#miform').submit(function(e){
      e.preventDefault();
      var link="{{route('rol.store')}}";
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#miform')[0]),
          success:function(response){
            if (response.error==1){
                //toastr.error(response.mensaje, 'Actualizar Registro', {timeOut:7000});
                toastr.error('revice sus errores por favor', 'Guardar Registro', {timeOut:7000});
               }else{
                  toastr.success('El registro fue guardado correctamente.', 'Guardar Registro', {timeOut:3000});
                  limpiarFormulario();  
                  removeClass();
                  recarga();
               }
          }
      })
   });

  function Modificar(id){
    $.ajax({
        url:"{{asset('')}}"+"rol/buscar/"+id, dataType:'json',
        success: function(resultado){
          removeClassEditarRol();
          $("#id_modal_rol").val(resultado.id);
          $("#nombre_modal_rol").val(resultado.name);
          $("#descripcion_modal_rol").val(resultado.descripcion);
          $('#modal-editar-rol').modal('show'); // abrir el modal
        }
    });         
  }
  //ACTUALIZAR UN REGISTRO
  $('#miform_editar_rol').submit(function(e){
      e.preventDefault();
      var id = $("#id_modal_rol").val();
      var link="{{asset('')}}"+"rol/update/"+id;
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#miform_editar_rol')[0]),
          success:function(response){
            if(response.error==1){
               // toastr.error(response.mensaje, 'Actualizar Registro', {timeOut:3000}) 
                toastr.error('revice sus errores por favor', 'Guardar Registro', {timeOut:7000})
            }else{
                toastr.success('El registro fue actualizado correctamente.', 'Actualizar Registro', {timeOut:3000});
                recarga(); 
                $('#modal-editar-rol').modal('hide'); // salir modal         
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
    var link="{{asset('')}}"+"rol/destroy/"+id;
      $.ajax({
          url: link,
          type: "GET",
          cache: false,
          async: false,
          success:function(resultado){
            toastr.error('El registro fue eliminado correctamente.', 'Eliminar Registro', {timeOut:3000})           
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
    var link="{{asset('')}}"+"rol/restore/"+id;
      $.ajax({
          url: link,
          type: "GET",
          cache: false,
          async: false,
          success:function(resultado){
            toastr.info('El registro fue restaurado correctamente.', 'Restaurar Registro', {timeOut:3000})           
          }
      })
    $('#ModalRestaurar').modal('hide'); // salir modal
    recarga();
  });
  //

  $('#miform').validate({
        rules: {
          nombre: {
            required: true,
          },
          descripcion: {
            required: true,
          }
        },
        messages: {
          nombre: {
            required: "Por favor, introduzca su nombre ",
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

    $('#miform_editar_rol').validate({
        rules: {
          nombre_modal_rol: {
            required: true,
          },
          descripcion_modal_rol: {
            required: true,
          }
        },
        messages: {
          nombre_modal_rol: {
            required: "Por favor, introduzca su nombre ",
          },
          descripcion_modal_rol: {
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
      $("#nombre").removeClass(["is-valid","is-invalid"]);
      $("#descripcion").removeClass(["is-valid","is-invalid"]);
    };
    function removeClassEditarRol(){
      $("#nombre_modal_rol").removeClass(["is-valid","is-invalid"]);
      $("#descripcion_modal_rol").removeClass(["is-valid","is-invalid"]);
    };


  </script>
@stop