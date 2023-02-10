@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Usuarios</h1>   
@stop
@section('content')
 
<ul class="nav nav-pills nav-tabs mb-3 justify-content-center">
  <li class="nav-item"><a class="nav-link active"  href="#Usuario"  data-toggle="tab"><i class="fas fa-user"></i>&nbsp;&nbsp;Usuarios</a></li>
  <li class="nav-item"><a class="nav-link" id="save_usuario" onclick="limpiarFormulario()" href="#UsuarioAgregar" data-toggle="tab"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a></li>
  <li class="nav-item"><a class="nav-link"    href="#UsuariosEliminados"  data-toggle="tab"><i class="far fa-trash-alt"></i>&nbsp;&nbsp;Eliminados</a></li>             
</ul>
<div class="tab-content">
  <div class="active tab-pane" id="Usuario">
    <div class="card {{ config('adminlte.classes_index', '') }}">
      <div class="card-header">
      <h3 class="card-title {{ config('adminlte.classes_index_header', '') }} ">LISTA DE USUARIOS</h3>
      </div>
      <div class="card-body">
          <table id="example1" class="table table-responsive-xl table-bordered table-sm table-hover table-striped">
              <thead>
                  <tr>
                    <th width="5%">Foto</th>
                    <th width="10%">Nombre</th>
                    <th width="10%">Apellidos</th>
                    <th width="20%">Email</th>
                    <th width="25%">Direccion</th>
                    <th width="10%">Telefono</th>
                    <th width="5%">Edad</th>
                    <th width="5%">Rol</th>
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
  <div class="tab-pane" id="UsuariosEliminados">
    <div class="card {{ config('adminlte.classes_index', '') }}">
      <div class="card-header">
      <h3 class="card-title {{ config('adminlte.classes_index_header', '') }} ">LISTA DE USUARIOS</h3>
      </div>
      <div class="card-body">
          <table id="example2" class="table table-responsive-xl table-bordered table-sm table-hover table-striped">
              <thead>
                  <tr>
                    <th width="5%">Foto</th>
                    <th width="10%">Nombre</th>
                    <th width="10%">Apellidos</th>
                    <th width="20%">Email</th>
                    <th width="25%">Direccion</th>
                    <th width="10%">Telefono</th>
                    <th width="5%">Edad</th>
                    <th width="5%">Rol</th>
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
  <div class="tab-pane" id="UsuarioAgregar">
    <div class="card {{ config('adminlte.classes_index', '') }}">
      <div class="card-header">
      <h3 class="card-title  {{ config('adminlte.classes_index_header', '') }}">AGREGAR USUARIO</h3>
      </div>
      <form  id="miform" name="miform" method="POST" novalidate="novalidate">
          @csrf
          <div class="card-body">
                  <div class="row">
                      <div class="col-sm-3">
                          <div class="form-group">
                              <label for="nombre" >Nombre</label>
                              <input type="text" name="nombre" class="form-control" id="nombre" placeholder="ingrese el nombre" aria-describedby="nombre-error" aria-invalid="true" >
                              <span id="nombre-error" class="error invalid-feedback" style="display: none;"></span>
                          </div>
                      </div>
                      <div class="col-sm-3">
                          <div class="form-group">
                              <label for="apellidos">Apellidos</label>
                              <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="ingrese sus apellidos" aria-describedby="apellidos-error" aria-invalid="true"/>
                              <span id="apellidos-error" class="error invalid-feedback" style="display: none;"></span>
                          </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="ingrese su correo" aria-describedby="email-error" aria-invalid="true"/>
                            <span id="email-error" class="error invalid-feedback" style="display: none;"></span>
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
                            <label for="edad">Edad</label>
                            <input type="number" step="any" name="edad" class="form-control" id="edad" placeholder="ingrese su edad" aria-describedby="edad-error" aria-invalid="true">
                            <span id="edad-error" class="error invalid-feedback" style="display: none;"></span>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="id_rol2">Rol</label>
                          <select class="form-control"  id="id_rol2" name="id_rol2" aria-describedby="id_rol2-error" aria-invalid="true">
                            <option disabled value="">Seleccionar rol</option>
                          </select>
                          <span id="id_rol2-error" class="error invalid-feedback" style="display: none;"></span>
                        </div>
                      </div>
                  </div>  
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="password">Contraseña</label> 
                        <input class="form-control" id="password" name="password" type="password" placeholder="ingrese su password " aria-describedby="password-error" aria-invalid="true"/>
                        <span id="password-error" class="error invalid-feedback" style="display: none;"></span>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="password_confirmation">Confirmar Contraseña</label> 
                        <input class="form-control" id="password_confirmation"  name="password_confirmation" type="password"  placeholder="Confirme su password " aria-describedby="password_confirmation-error" aria-invalid="true" /> 
                        <span id="password_confirmation-error" class="error invalid-feedback" style="display: none;"></span>
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
                        <div class="form-group" >
                          <input style="cursor: pointer;" type="file" id="img_foto" name="img_foto" class="custom-file-input" aria-describedby="img_foto-error" aria-invalid="true" accept="image/jpeg,jpg" >
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
    <div class="modal fade" id="modal-editar-usuario" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="card {{ config('adminlte.classes_modal', '') }}">
              <div class="card-header">
              <h3 class="card-title  {{ config('adminlte.classes_modal_header', '') }}">Datos Actuales</h3>
              </div>
              <form  id="miform_editar_usuario" name="miform_editar_usuario" method="POST" novalidate="novalidate">
                @csrf
                <input type="hidden" name="id_modal_usuario" id="id_modal_usuario">
                <input type="hidden" name="id_rol_aux_modal_usuario" id="id_rol_aux_modal_usuario">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="nombre_modal_usuario" >Nombre</label>
                                <input disabled type="text" name="nombre_modal_usuario" class="form-control" id="nombre_modal_usuario" placeholder="ingrese el nombre" aria-describedby="nombre_modal_usuario-error" aria-invalid="true" >
                                <span id="nombre_modal_usuario-error" class="error invalid-feedback" style="display: none;"></span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="apellidos_modal_usuario">Apellidos</label>
                                <input disabled type="text" name="apellidos_modal_usuario" class="form-control" id="apellidos_modal_usuario" placeholder="ingrese sus apellidos" aria-describedby="apellidos_modal_usuario-error" aria-invalid="true"/>
                                <span id="apellidos_modal_usuario-error" class="error invalid-feedback" style="display: none;"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="email_modal_usuario">Email</label>
                              <input disabled type="email" name="email_modal_usuario" class="form-control" id="email_modal_usuario" placeholder="ingrese su correo" aria-describedby="email_modal_usuario-error" aria-invalid="true"/>
                              <span id="email_modal_usuario-error" class="error invalid-feedback" style="display: none;"></span>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label for="direccion_modal_usuario">Direccion</label>
                            <textarea disabled type="text" name="direccion_modal_usuario" class="form-control" id="direccion_modal_usuario" placeholder="ingrese la direccion" aria-describedby="direccion_modal_usuario-error" aria-invalid="true"></textarea>
                            <span id="direccion_modal_usuario-error" class="error invalid-feedback" style="display: none;"></span>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                              <label for="telefono_modal_usuario">telefono</label>
                              <input disabled type="number" name="telefono_modal_usuario" class="form-control" id="telefono_modal_usuario"  placeholder="ingrese el nro: telefono" aria-describedby="telefono_modal_usuario-error" aria-invalid="true">
                              <span id="telefono_modal_usuario-error" class="error invalid-feedback" style="display: none;"></span>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                              <label for="edad_modal_usuario">Edad</label>
                              <input disabled type="number"  name="edad_modal_usuario" class="form-control" id="edad_modal_usuario" placeholder="ingrese su edad" aria-describedby="edad_modal_usuario-error" aria-invalid="true">
                              <span id="edad_modal_usuario-error" class="error invalid-feedback" style="display: none;"></span>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          
                        </div>
                    </div>  
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="id_rol2_modal_usuario">Rol</label>
                          <select class="form-control"  id="id_rol2_modal_usuario" name="id_rol2_modal_usuario" aria-describedby="id_rol2_modal_usuario-error" aria-invalid="true">
                            <option disabled value="">Seleccionar rol</option>
                          </select>
                          <span id="id_rol2_modal_usuario-error" class="error invalid-feedback" style="display: none;"></span>
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
  Inactivo('#example2');
  
  ////////
  function Activo(tabla){   
    $(tabla).DataTable({ 
        destroy: true,
        retrieve: true,
        // processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        cache: false,
        ajax: "{{route('usuario.DatosServerSideActivo')}}",
        dataType: 'json',
        type: "POST",
        columns: [
          {data: 'foto', searchable: false, orderable: false},
          {data: 'name'},
          {data: 'apellidos'},
          {data: 'email'},
          {data: 'direccion',searchable: false,orderable: false},
          {data: 'telefono',searchable: false,orderable: false},
          {data: 'edad'},
          {data: 'rol_uso'},
          {data: 'estado'},
          {data: 'actions',searchable: false,orderable: false}
        ]
    });
  };
  
  /////////
  function Inactivo(tabla){ 
    $(tabla).DataTable({ 
        destroy: true,
        retrieve: true,
        // processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        cache: false,
        ajax: "{{route('usuario.DatosServerSideInactivo')}}",
        dataType: 'json',
        type: "POST",
        columns: [
          {data: 'foto', searchable: false, orderable: false},
          {data: 'name'},
          {data: 'apellidos'},
          {data: 'email'},
          {data: 'direccion',searchable: false,orderable: false},
          {data: 'telefono',searchable: false,orderable: false},
          {data: 'edad'},
          {data: 'rol_uso'},
          {data: 'estado'},
          {data: 'actions',searchable: false,orderable: false}
        ]
    });
  }
  /////////
  function recarga(){
    $('#example1').DataTable().ajax.reload();
    $("#example2").DataTable().ajax.reload();   
  }
  
//////////////////////////////////////////////////////////////////
 
  $('#save_usuario').click(function(){  // CARGAR LOS ROLES DISPONIBLES PAL USUARIO
    $.ajax({
        url:"{{asset('')}}"+"usuario/buscar/"+-1, dataType:'json',
        success: function(resultado){
          ////////////colocar el array al selectd ////////////////////
          $('#id_rol2').empty(); // limpiar antes de sobreescribir
          $('#id_rol2').append($('<option  />', {
                 text: 'seleccione un rol',
                 disabled: true,
                 selected:true,
          }));
          resultado.roles.forEach(function(elemento, indice, array) {
                 $('#id_rol2').append($('<option  />', {
                 text: elemento.name,
                 value: elemento.id,
                 }));
          
          });
        }
    }); 
  });      
 

  //guardar 
  $('#miform').submit(function(e){
      e.preventDefault();
      var link="{{route('usuario.store')}}";
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#miform')[0]),    
          success:function(response){
            if(response.error_email==1){
              toastr.error(response.mensaje, 'Guardar Registro', {timeOut:7000});
            }
            if(response.error_password==1){
              toastr.error(response.mensaje, 'Guardar Registro', {timeOut:7000});
            }
            if (response.error==1){
               // toastr.error(response.mensaje, 'Guardar Registro', {timeOut:7000})
              toastr.error('revice sus errores por favor', 'Guardar Registro', {timeOut:7000});
            }
            if (response.error==0){
              toastr.success('El registro fue guardado correctamente.', 'Guardar Registro', {timeOut:3000}); 
              recarga();
              removeClass();
              limpiarFormulario(); 
            }
          }
      })
    
  });

  function Modificar(id){
    $.ajax({
        url:"{{asset('')}}"+"usuario/buscar/"+id, dataType:'json',
        success: function(resultado){
          removeClassEditarUsuario();
          $("#id_modal_usuario").val(resultado.datos.id); // ID del usuario
          $("#id_rol_aux_modal_usuario").val(resultado.id_rol_user); // id rol actual
          $("#nombre_modal_usuario").val(resultado.datos.name);
          $("#apellidos_modal_usuario").val(resultado.datos.apellidos);
          $("#edad_modal_usuario").val(resultado.datos.edad);
          $("#email_modal_usuario").val(resultado.datos.email);
          $("#direccion_modal_usuario").val(resultado.datos.direccion);
          ////////////colocar el array al selectd ////////////////////
          $('#id_rol2_modal_usuario').empty(); // limpiar antes de sobreescribir
          resultado.roles.forEach(function(elemento, indice, array) {
             if (elemento.id==resultado.id_rol_user){ //seleccionar con selected
                 $('#id_rol2_modal_usuario').append($('<option  />', {
                 text: elemento.name,
                 value: elemento.id,
                 selected: true, //
                 }));
             }else{
               $('#id_rol2_modal_usuario').append($('<option  />', {
               text: elemento.name,
               value: elemento.id,
               }));
             }
          }); 
          ///////////////////////////////////////////////////////////
          $('#modal-editar-usuario').modal('show'); // abrir el modal
        }
    });         
  };
  //ACTUALIZAR UN REGISTRO
  $('#miform_editar_usuario').submit(function(e){
    e.preventDefault();
    var id_rol_nuevo = $("#id_rol2_modal_usuario").val();
    var id_rol_antiguo = $("#id_rol_aux_modal_usuario").val();
    var id = $("#id_modal_usuario").val(); // id usuario
    var _token2 = $("input[name=_token]").val();
    var link="{{asset('')}}"+"usuario/update/"+id;
    $.ajax({
      url: link,
      type: "POST",
      cache: false,
      async: false,
      data:{
          id_rol_nuevo:id_rol_nuevo,
          id_rol_antiguo:id_rol_antiguo,
          _token:_token2
      },
      success:function(response){
        if(response.error==1){
          // toastr.error(response.mensaje, 'Actualizar Registro', {timeOut:3000}) 
          toastr.error('revice sus errores por favor', 'Guardar Registro', {timeOut:7000})
        }else{
            toastr.success('El registro fue actualizado correctamente.', 'Actualizar Registro', {timeOut:3000});
            recarga(); 
            $('#modal-editar-usuario').modal('hide'); // salir modal         
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
    var link="{{asset('')}}"+"usuario/destroy/"+id;
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
    var link="{{asset('')}}"+"usuario/restore/"+id;
    $.ajax({
      url: link,
      type: "GET",
      cache: false,
      async: false,
      success:function(resultado){
        toastr.success('El registro fue restaurado correctamente.', 'Restaurar Registro', {timeOut:3000});
        $('#ModalRestaurar').modal('hide'); // salir modal
        recarga();         
      }
    })
  });
  

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
          password: {
            required: true,
            minlength: 5,
          },
          password_confirmation: {
            required: true,
            minlength: 5,
            equalTo: "#password"
          },
          email: {
            required: true,
            email:true
          },
          id_rol2: {
            required: true,
          },
          edad: {
            required: true,
            min: 2
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
          edad: {
            required: "Por favor, introduzca su edad",
            min: "Permitido mayor o igual a 10"
          },
          id_rol2: {
            required: "Por favor, seleccione un rol",
          },
          password: {
            required: "Por favor, introduzca su password",
          },
          password_confirmation: {
            required: "Por favor, introduzca su password de confirmacion",
            equalTo: "Por favor, Verifique su Password si son iguales"
          },
          email: {
            required: "Por favor, introduzca su correo",
            email: "El Correo no es valido"
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

    $('#miform_editar_usuario').validate({
        rules: { 
          id_rol2_modal_usuario: {
            required: true,
          }
        },
        messages: {
          id_rol2: {
            required: "Por favor, seleccione un rol",
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
      document.getElementById("blah").src= "{{asset('imagenes/usuarios/150x150.png')}}";
      $("#nombre").removeClass(["is-valid","is-invalid"]);
      $("#apellidos").removeClass(["is-valid","is-invalid"]);
      $("#telefono").removeClass(["is-valid","is-invalid"]);
      $("#direccion").removeClass(["is-valid","is-invalid"]);
      $("#img_foto").removeClass(["is-valid","is-invalid"]);
      $("#email").removeClass(["is-valid","is-invalid"]);
      $("#id_rol2").removeClass(["is-valid","is-invalid"]);
      $("#edad").removeClass(["is-valid","is-invalid"]);
      $("#password").removeClass(["is-valid","is-invalid"]);
      $("#password_confirmation").removeClass(["is-valid","is-invalid"]);
    }
    function removeClassEditarUsuario(){
      $("#id_rol2_modal_usuario").removeClass(["is-valid","is-invalid"]);
    }


</script>

@stop
