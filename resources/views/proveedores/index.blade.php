@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Proveedores</h1>   
@stop
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active"  href="#Proveedor"  data-toggle="tab"><i class="fas fa-user"></i>&nbsp;&nbsp;Proveedores</a></li>
                <li class="nav-item"><a class="nav-link"  onclick="limpiarFormulario()" href="#ProveedorAgregar" data-toggle="tab"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a></li>
                <li class="nav-item"><a class="nav-link"    href="#ProveedorEliminados"  data-toggle="tab"><i class="far fa-trash-alt"></i>&nbsp;&nbsp;Eliminados</a></li>             
            </ul>
        </div> 
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="Proveedor">
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
                <div class="tab-pane" id="ProveedorEliminados">
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
                <div class="tab-pane" id="ProveedorAgregar">
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title">Agregar Proveedor</h3>
                        </div>
                        <form  id="miform" novalidate="novalidate">
                            <div class="card-body">
                                
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="escriba su nombre o razon social" aria-describedby="exampleInputEmail1-error" aria-invalid="false">
                                                <span id="exampleInputnombre-error" class="error invalid-feedback" style="display: none;"></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Direccion</label>
                                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" aria-describedby="exampleInputPassword1-error" aria-invalid="false">
                                                <span id="exampleInputPassword1-error" class="error invalid-feedback" style="display: none;"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="tipo">tipo proveedor</label>
                                                <select class="form-control" name="tipo" id="tipo">
                                                    <option value="1">Persona</option>
                                                    <option value="2">Empresa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                   
                               
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
  $('#miform2').submit(function(e){
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
<script type="text/javascript">
    $(document).ready(function () {
      $.validator.setDefaults({
        submitHandler: function () {
          alert( "Form successful submitted!" );
        }
      });
      $('#miform').validate({
        rules: {
          nombre: {
            required: true,
            minlength: 10
          },
          password: {
            required: true,
            minlength: 5
          },
          terms: {
            required: true
          },
        },
        messages: {
          nombre: {
            required: "Por favor, introduzca un nombre ",
            minlength: "Por favor, su campo nombre esta vacio"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
          },
          terms: "Please accept our terms"
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
          $(element).removeClass('is-invalid');
        }
      });
    });
    </script>
@stop
