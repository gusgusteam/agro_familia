@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Empleados</h1>   
@stop
@section('content')
    <div class="container-fluid">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active"  href="#Empleado"  data-toggle="tab"><i class="fas fa-user"></i>&nbsp;&nbsp;Empleado</a></li>
                <li class="nav-item"><a class="nav-link" id="save_usuario" onclick="limpiarFormulario()" href="#EmpleadoAgregar" data-toggle="tab"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a></li>
                <li class="nav-item"><a class="nav-link"    href="#EmpleadoEliminados"  data-toggle="tab"><i class="far fa-trash-alt"></i>&nbsp;&nbsp;Eliminados</a></li>             
               </ul>
            </div> 
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="Empleado">
                    <table id="example1" class="table table-responsive-xl table-bordered table-sm table-hover table-striped">
                        <thead>
                            <tr>
                              <th width="4%">Foto</th>
                              <th width="4%"> id </th>
                              <th>Nombre</th>
                              <th>Apellidos</th>
                              <th>Direccion</th>
                              <th>Telefono</th>
                              <th>Nro carnet</th>
                              <th>Sueldo</th>
                              <th width="5%">Acción</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
                <div class="tab-pane" id="EmpleadoEliminados">
                    <table id="example2" class="table table-responsive-xl table-bordered table-sm table-hover table-striped"  >
                        <thead>
                            <tr>  
                                <th width="4%">Foto</th>
                                <th width="4%" > id </th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Direccion</th>
                                <th>Telefono</th>
                                <th>Nro carnet</th>
                                <th>Sueldo</th>
                                <th width="5%">Acción</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                    </table>  
                </div>
                <div class="tab-pane" id="EmpleadoAgregar">
                    <form id="miform"  enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label> 
                                    <input class="form-control" id="nombre" name="nombre" type="text" placeholder="ingrese un nombre "  required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="apellidos">Apellidos</label> 
                                    <input class="form-control" id="apellidos" name="apellidos" type="text"  placeholder="ingrese sus apellidos" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="direccion">Direccion</label> 
                                    <input class="form-control" id="direccion" name="direccion" type="text" placeholder="ingrese sus direccion"  required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="telefono">Telefono</label> 
                                    <input class="form-control" id="telefono" name="telefono" type="number" placeholder="ingrese su numero de telefono" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="sueldo">Sueldo</label> 
                                    <input class="form-control" id="sueldo" name="sueldo" type="number" placeholder="ingrese su sueldo" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nro_carnet">Nro carnet</label> 
                                    <input class="form-control" id="nro_carnet" name="nro_carnet" type="number"  placeholder="ingrese su numero de carnet " required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label for="customFile">Previsualizar imagen</label>
                                    <div class="row col-sm-6">
                                        <img id="blah" class="img-fluid" src="{{asset('imagenes/usuarios/150x150.png')}}" alt="Photo" style="max-height: 160px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-sm-6">
                            <div class="custom-file">
                                <input style="cursor: pointer;" type="file" id="img_perfil" name="img_perfil" class="custom-file-input" accept="image/jpeg,jpg" >
                                <label class="custom-file-label align-middle" for="img_perfil" data-browse="Buscar">Seleccione una foto</label>
                            </div>
                            </div>   
                        </div>
                        <br>
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
          <h5 class="modal-title" id="exampleModalLabel">Editar Empleado</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="FormEdicion">
          @csrf
          <div class="modal-body">
            <input type="hidden" class="form-control" id="id_edit" value="0">
            <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                      <label for="nombreM">Nombre</label>
                      <input type="text" class="form-control" name="nombreM" id="nombreM" placeholder="Escriba el nombre">
                  </div>
              </div>
              <div class="col-sm-6">
                  <div class="form-group">
                      <label for="apellidosM">Apellidos</label>
                      <input type="text" class="form-control" name="apellidosM" id="apellidosM" placeholder="No puede editar" >
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                      <label for="direccionM">Direccion</label>
                      <input type="text" class="form-control" name="direccionM" id="direccionM" placeholder="No puede editar" >
                  </div>
              </div>
              <div class="col-sm-6">
                  <div class="form-group">
                    <label for="telefonoM">Telefono</label>
                    <input type="number" class="form-control" name="telefonoM" id="telefonoM" placeholder="ingrese su numero telefonico" >
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="nro_carnetM">Nro Carnet</label>
                  <input type="number" class="form-control" name="nro_carnetM" id="nro_carnetM" placeholder="Nro de carnet" >
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                    <label for="sueldoM">Sueldo</label>
                    <input type="number" class="form-control" name="sueldoM" id="sueldoM" placeholder="Nro de carnet" >

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
@section('plugins.Sweetalert2', true)
@section('js')

<script> 

  Activo('#example1') // con que index va iniciar
  Inactivo('#example2') 
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
            {data: 'foto'},
            {data: 'id',searchable: false,orderable: false},
            {data: 'nombre'},
            {data: 'apellidos'},
            {data: 'direccion'},
            {data: 'telefono',searchable: false,orderable: false},
            {data: 'nro_carnet'},
            {data: 'sueldo',searchable: false,orderable: false},
            {data: 'actions',searchable: false,orderable: false}
        ],
      });
  }
  /////////
  function Inactivo(tabla){   
        $(tabla).DataTable({ 
          destroy: true,
          retrieve: true,
          serverSide: true,
          autoWidth: false,
          responsive: true,
          ajax: "{{route('empleado.DatosServerSideInactivo')}}",
          dataType: 'json',
          type: "POST",
          columns: [
            {data: 'foto'},
            {data: 'id',searchable: false,orderable: false},
            {data: 'nombre'},
            {data: 'apellidos'},
            {data: 'direccion'},
            {data: 'telefono',searchable: false,orderable: false},
            {data: 'nro_carnet'},
            {data: 'sueldo',searchable: false,orderable: false},
            {data: 'actions',searchable: false,orderable: false}
        ],
      })
  }

  function recarga(){
     $('#example1').DataTable().ajax.reload();
     $("#example2").DataTable().ajax.reload();
  }  
 
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
        url:"{{asset('')}}"+"empleado/buscar/"+id, dataType:'json',
        success: function(resultado){
          $("#id_edit").val(resultado.id); // ID del usuario
          $("#nombreM").val(resultado.nombre);
          $("#apellidosM").val(resultado.apellidos);
          $("#sueldoM").val(resultado.sueldo);
          $("#telefonoM").val(resultado.telefono);
          $("#nro_carnetM").val(resultado.nro_carnet);
          $("#direccionM").val(resultado.direccion);
          $('#ModalEditar').modal('show'); // abrir el modal
        }
    });         
  };
  //ACTUALIZAR UN REGISTRO
  $('#FormEdicion').submit(function(e){
      e.preventDefault();
      var id = $("#id_edit").val(); // id usuario
      var link="{{asset('')}}"+"empleado/update/"+id;
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#FormEdicion')[0]), 
          success:function(response){
              if(response.error==1){
                toastr.error(response.mensaje, 'Actualizar Registro', {timeOut:3000}) 
              }else{
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
            toastr.success('El registro fue eliminado correctamente.', 'Eliminar Registro', {timeOut:3000})   
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
  //

  function Imagen(image){
    Swal.fire({
    title: '',
    text: '',
    imageUrl: image,
    imageWidth: 400,
    imageHeight: 400,
    imageAlt: 'Custom image',
    }) 
  }
</script>


<script type="text/javascript">
    function readImage (input) {
        if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        }
    }
    $("#img_perfil").change(function () {
        readImage(this);
    });
</script>

@stop
