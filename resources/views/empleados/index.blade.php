@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Empleados</h1>   
@stop
@section('content')
<ul class="nav nav-pills nav-tabs mb-3 justify-content-center">
    <li class="nav-item"><a class="nav-link active"  href="#Empleado"  data-toggle="tab"><i class="fas fa-user"></i>&nbsp;&nbsp;Empleado</a></li>
    <li class="nav-item"><a class="nav-link" id="save_usuario" onclick="limpiarFormulario()" href="#EmpleadoAgregar" data-toggle="tab"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a></li>
</ul>
<div class="tab-content">
    <div class="active tab-pane" id="Empleado">
        <div class="card {{ config('adminlte.classes_index', '') }}">
            <div class="card-header">
            <h3 class="card-title {{ config('adminlte.classes_index_header', '') }} ">LISTA DE EMPLEADOS</h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <select  name="filtro" id="filtro" value="" class="form-control form-control-sm" >
                        <option value="0">Empleados Inactivos</option>
                        <option value="1">Empleados Activos</option>
                        <option selected value="2">Todos los empleados</option>
                        </select>
                    </div>
                </div>
        
                <table id="example1" class="table table-responsive-xl table-bordered table-sm table-hover table-striped">
                    <thead>
                        <tr>
                            <th width="5%">Foto</th>
                            <th width="15%">Nombre</th>
                            <th width="20%">Apellidos</th>
                            <th width="20%">Direccion</th>
                            <th width="15%">Telefono</th>
                            <th width="10%">Nro carnet</th>
                            <th width="5%">Sueldo</th>
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
    <div class="tab-pane" id="EmpleadoAgregar">
        <div class="card {{ config('adminlte.classes_index', '') }}">
            <div class="card-header">
            <h3 class="card-title  {{ config('adminlte.classes_index_header', '') }}">AGREGAR EMPLEADO</h3>
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
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="ingrese sus apellidos" aria-describedby="apellidos-error" aria-invalid="true"/>
                                    <span id="apellidos-error" class="error invalid-feedback" style="display: none;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="direccion">Direccion</label>
                                <textarea type="text" name="direccion" class="form-control" id="direccion" placeholder="ingrese la direccion" aria-describedby="direccion-error" aria-invalid="true"></textarea>
                                <span id="direccion-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                  <label for="telefono">telefono</label>
                                  <input type="number" name="telefono" class="form-control" id="telefono"  placeholder="ingrese el nro: telefono" aria-describedby="telefono-error" aria-invalid="true">
                                  <span id="telefono-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                  <label for="sueldo">Sueldo</label>
                                  <input type="number" step="any" name="sueldo" class="form-control" id="sueldo" placeholder="ingrese su sueldo" aria-describedby="sueldo-error" aria-invalid="true">
                                  <span id="sueldo-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                  <label for="nro_carnet">N: carnet</label>
                                  <input type="number" step="any" name="nro_carnet" class="form-control" id="nro_carnet" placeholder="ingrese su nro: carnet" aria-describedby="nro_carnet-error" aria-invalid="true">
                                  <span id="nro_carnet-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                            </div>
                        </div>                  
                        <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                              <label for="customFile">Previsualizar imagen</label>
                                  <div class="row col-sm-6">
                                      <img id="blah" class="img-fluid" src="{{asset('imagenes/productos/150x150.png')}}" alt="Photo" style="max-height: 160px;">
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="row" >
                          <div class="col-sm-6">
                            <div class="custom-file">
                              <div class="form-group" >
                                <input style="cursor: pointer;" type="file" id="img_foto" name="img_foto" class="custom-file-input" aria-describedby="img_foto-error" aria-invalid="true" accept="image/png" >
                                <span id="img_foto" class="error invalid-feedback" style="display: none;"></span>
                                <label class="custom-file-label align-middle" for="img_foto" data-browse="Buscar">Seleccione una foto</label>
                              </div>
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


  <!-- Modal -->
  <div class="modal fade" id="modal-editar-empleado" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
          <div class="card {{ config('adminlte.classes_modal', '') }}">
            <div class="card-header">
            <h3 class="card-title  {{ config('adminlte.classes_modal_header', '') }}">Datos Actuales</h3>
            </div>
            <form  id="miform_editar_empleado" name="miform_editar_empleado" method="POST" novalidate="novalidate">
                @csrf
                <input type="hidden" name="id_empleado_modal" id="id_empleado_modal">
                <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nombre_modal_empleado" >Nombre</label>
                                    <input type="text" name="nombre_modal_empleado" class="form-control" id="nombre_modal_empleado" placeholder="ingrese su nombre" aria-describedby="nombre_modal_empleado-error" aria-invalid="true" >
                                    <span id="nombre_modal_empleado-error" class="error invalid-feedback" style="display: none;"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="apellidos_modal_empleado">Apellidos</label>
                                    <input type="text" name="apellidos_modal_empleado" class="form-control" id="apellidos_modal_empleado" placeholder="ingrese sus apellidos" aria-describedby="apellidos_modal_empleado-error" aria-invalid="true"/>
                                    <span id="apellidos-error" class="error invalid-feedback" style="display: none;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="direccion_modal_empleado">Direccion</label>
                                <textarea type="text" name="direccion_modal_empleado" class="form-control" id="direccion_modal_empleado" placeholder="ingrese la direccion" aria-describedby="direccion_modal_empleado-error" aria-invalid="true"></textarea>
                                <span id="direccion_modal_empleado-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                  <label for="telefono_modal_empleado">telefono</label>
                                  <input type="number" name="telefono_modal_empleado" class="form-control" id="telefono_modal_empleado"  placeholder="ingrese el nro: telefono" aria-describedby="telefono_modal_empleado-error" aria-invalid="true">
                                  <span id="telefono_modal_empleado-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                  <label for="sueldo_modal_empleado">Sueldo</label>
                                  <input type="number"  name="sueldo_modal_empleado" class="form-control" id="sueldo_modal_empleado" placeholder="ingrese su sueldo" aria-describedby="sueldo_modal_empleado-error" aria-invalid="true">
                                  <span id="sueldo_modal_empleado-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                  <label for="nro_carnet_modal_empleado">N: carnet</label>
                                  <input type="number" name="nro_carnet_modal_empleado" class="form-control" id="nro_carnet_modal_empleado" placeholder="ingrese su nro: carnet" aria-describedby="nro_carnet_modal_empleado-error" aria-invalid="true">
                                  <span id="nro_carnet_modal_empleado-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                            </div>
                        </div>                  
                        <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                              <label for="customFile">Previsualizar imagen</label>
                                  <div class="row col-sm-6">
                                      <img id="blah_empleado" class="img-fluid" src="{{asset('imagenes/empleados/150x150.png')}}" alt="Photo" style="max-height: 160px;">
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="row" >
                          <div class="col-sm-6">
                            <div class="custom-file">
                              <div class="form-group" >
                                <input style="cursor: pointer;" type="file" id="img_foto_modal" name="img_foto" class="custom-file-input" aria-describedby="img_foto_modal-error" aria-invalid="true" accept="image/jpeg,jpg" >
                                <span id="img_foto_modal_empleado" class="error invalid-feedback" style="display: none;"></span>
                                <label class="custom-file-label align-middle" for="img_foto_modal" data-browse="Buscar">Seleccione una foto</label>
                              </div>
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
@section('plugins.Sweetalert2', true)
@section('js')

<script> 

  Activo('#example1'); // con que index va iniciar
  $('#filtro').change(function (e) { 
    if($(this).val()==0){
     // $('#example1').DataTable().search( ':inactivo' ).draw();
     $('#example1').DataTable().column(7).search(': inactivo', true, false, true).draw();
    }
    if($(this).val()==1){
     $('#example1').DataTable().column(7).search(': activo', true, false, true).draw();
    }
    if($(this).val()==2){
     $('#example1').DataTable().column(7).search(':', true, false, true).draw();
    }
  });
  //Inactivo('#example2') 
  ////////

  function Activo(tabla){   
        $(tabla).DataTable({ 
          destroy: true,
          retrieve: true,
          serverSide: true,
          autoWidth: false,
          responsive: true,
          ajax: "{{route('empleado.DatosServerSideActivo')}}",
          dataType: 'json',
          type: "POST",
          columns: [
            {data: 'foto',searchable: false,orderable: false},
            {data: 'nombre'},
            {data: 'apellidos'},
            {data: 'direccion'},
            {data: 'telefono'},
            {data: 'nro_carnet'},
            {data: 'sueldo',searchable: false,orderable: false},
            {data: 'estado'},
            {data: 'actions',searchable: false,orderable: false}
        ],
      });
  };
  
  function recarga(){
     $('#example1').DataTable().ajax.reload();
  };  
 
  //guardar 
  $('#miform').submit(function(e){
      e.preventDefault();
      var link="{{route('empleado.store')}}";
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#miform')[0]),    
          success:function(response){
            if (response.error==1){
               // toastr.error(response.mensaje, 'Guardar Registro', {timeOut:7000})
                toastr.error('revice sus errores por favor', 'Guardar Registro', {timeOut:7000});
               }else{
                  toastr.success('El registro fue guardado correctamente.', 'Guardar Registro', {timeOut:3000}); 
                  recarga();
                  limpiarFormulario();
                  removeClass();  
               }
          }
      })
    
  });

  function Modificar(id){
    $.ajax({
        url:"{{asset('')}}"+"empleado/buscar/"+id, dataType:'json',
        success: function(resultado){
          document.getElementById("miform_editar_empleado").reset();
          removeClassEditarEmpleado();
          $("#id_empleado_modal").val(resultado.empleado.id); 
          $("#nombre_modal_empleado").val(resultado.empleado.nombre);
          $("#apellidos_modal_empleado").val(resultado.empleado.apellidos);
          $("#sueldo_modal_empleado").val(resultado.empleado.sueldo);
          $("#telefono_modal_empleado").val(resultado.empleado.telefono);
          $("#nro_carnet_modal_empleado").val(resultado.empleado.nro_carnet);
          $("#direccion_modal_empleado").val(resultado.empleado.direccion);
          $("#blah_empleado").attr("src",resultado.url_foto);
          $('#modal-editar-empleado').modal('show'); // abrir el modal
        }
    });         
  };
  //ACTUALIZAR UN REGISTRO
  $('#miform_editar_empleado').submit(function(e){
      e.preventDefault();
      var id = $("#id_empleado_modal").val(); // id usuario
      var link="{{asset('')}}"+"empleado/update/"+id;
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#miform_editar_empleado')[0]), 
          success:function(response){
              if(response.error==1){
               // toastr.error(response.mensaje, 'Actualizar Registro', {timeOut:3000}) 
                toastr.error('revice sus errores por favor', 'Guardar Registro', {timeOut:7000})
              }else{
                  toastr.success('El registro fue actualizado correctamente.', 'Actualizar Registro', {timeOut:3000});
                  recarga(); 
                  $('#modal-editar-empleado').modal('hide'); // salir modal         
              }
          }
      })
    
    });
  //

  function Eliminar(id){ // modal
    $("#id_delete").val(id);
    $('#ModalEliminar').modal('show');
  };
  
  // ELIMINAR UN REGISTRO
  $('#Delete').click(function(){
    var id = $("#id_delete").val();
    var link="{{asset('')}}"+"empleado/destroy/"+id;
      $.ajax({
          url: link,
          type: "GET",
          cache: false,
          async: false,
          success:function(resultado){
            toastr.success('El registro fue eliminado correctamente.', 'Eliminar Registro', {timeOut:3000}); 
            $('#ModalEliminar').modal('hide'); // salir modal
            recarga();        
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
    var link="{{asset('')}}"+"empleado/restore/"+id;
      $.ajax({
          url: link,
          type: "GET",
          cache: false,
          async: false,
          success:function(resultado){
            toastr.success('El registro fue restaurado correctamente.', 'Restaurar Registro', {timeOut:3000})  
            $('#ModalRestaurar').modal('hide'); // salir modal
            recarga();         
          }
      })
    
  });
</script>


<script type="text/javascript">

    $('#miform').validate({
        rules: {
          nombre: {
            required: true,
          },
          apellidos: {
            required: true,
          },
          telefono: {
            required: true,
          },
          direccion: {
            required: true,
          },
          nro_carnet: {
            required: true,
          },
          sueldo: {
            required: true,
            min: 1
          },
          img_foto:{
            required:false,
          }
        },
        messages: {
          nombre: {
            required: "Por favor, introduzca su nombre ",
          },
          direccion: {
            required: "Por favor, introduzca su direccion ",
          },
          apellidos: {
            required: "Por favor, introduzca sus apellidos",  
          },
          telefono: {
            required: "Por favor, introduzca su n: telefono",
          },
          sueldo: {
            required: "Por favor, introduzca su sueldo",
            min: "Por favor, precio mayor o igual a 1"
          },
          nro_carnet: {
            required: "Por favor, introduzca su n: carnet",
          },
          img_foto: {
            required: "Por favor, seleccione una imagen es obligatorio",
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

    $('#miform_editar_empleado').validate({
        rules: {
          nombre_modal_empleado: {
            required: true,
          },
          apellidos_modal_empleado: {
            required: true,
          },
          telefono_modal_empleado: {
            required: true,
          },
          direccion_modal_empleado: {
            required: true,
          },
          nro_carnet_modal_empleado: {
            required: true,
          },
          sueldo_modal_empleado: {
            required: true,
            min: 1
          },
          img_foto_modal_empleado:{
            required:false,
          }
        },
        messages: {
          nombre_modal_empleado: {
            required: "Por favor, introduzca su nombre ",
          },
          direccion_modal_empleado: {
            required: "Por favor, introduzca su direccion ",
          },
          apellidos_modal_empleado: {
            required: "Por favor, introduzca sus apellidos",  
          },
          telefono_modal_empleado: {
            required: "Por favor, introduzca su n: telefono",
          },
          sueldo_modal_empleado: {
            required: "Por favor, introduzca su sueldo",
            min: "Por favor, precio mayor o igual a 1"
          },
          nro_carnet_modal_empleado: {
            required: "Por favor, introduzca su n: carnet",
          },
          img_foto_modal_empleado: {
            required: "Por favor, seleccione una imagen es obligatorio",
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
      document.getElementById("blah").src= "{{asset('imagenes/empleados/150x150.png')}}";
      $("#nombre").removeClass(["is-valid","is-invalid"]);
      $("#apellidos").removeClass(["is-valid","is-invalid"]);
      $("#telefono").removeClass(["is-valid","is-invalid"]);
      $("#direccion").removeClass(["is-valid","is-invalid"]);
      $("#img_foto").removeClass(["is-valid","is-invalid"]);
      $("#sueldo").removeClass(["is-valid","is-invalid"]);
      $("#nro_carnet").removeClass(["is-valid","is-invalid"]);
    };
    function removeClassEditarEmpleado(){
      $("#nombre_modal_empleado").removeClass(["is-valid","is-invalid"]);
      $("#apellidos_modal_empleado").removeClass(["is-valid","is-invalid"]);
      $("#telefono_modal_empleado").removeClass(["is-valid","is-invalid"]);
      $("#direccion_modal_empleado").removeClass(["is-valid","is-invalid"]);
      $("#img_foto_modal_empleado").removeClass(["is-valid","is-invalid"]);
      $("#sueldo_modal_empleado").removeClass(["is-valid","is-invalid"]);
      $("#nro_carnet_modal_empleado").removeClass(["is-valid","is-invalid"]);
    };


    function readImagePersonal (input,campo) {
            if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(campo).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            }
    };

    $("#img_foto_modal_empleado").change(function () {
        readImagePersonal(this,"#blah_empleado");
    });

</script>

@stop
