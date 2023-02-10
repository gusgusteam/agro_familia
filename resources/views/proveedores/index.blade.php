@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Proveedores</h1>   
@stop
@section('content')
  <ul class="nav nav-pills nav-tabs mb-3 justify-content-center">
    <li class="nav-item"><a class="nav-link active"  href="#Proveedor"  data-toggle="tab"><i class="far fa-address-card"></i>&nbsp;&nbsp;Personas</a></li>
    <li class="nav-item"><a class="nav-link"  onclick="limpiarFormulario()" href="#ProveedorAgregar" data-toggle="tab"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a></li>
    <li class="nav-item"><a class="nav-link"    href="#ProveedorEmpresa"  data-toggle="tab"><i class="far fa-building"></i>&nbsp;&nbsp;Empresas</a></li>            
  </ul>
  <div class="tab-content">
      <div class="active tab-pane" id="Proveedor">
        <div class="card {{ config('adminlte.classes_index', '') }}">
          <div class="card-header">
          <h3 class="card-title {{ config('adminlte.classes_index_header', '') }}">LISTA DE PERSONAS</h3>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-sm-2">
                <select  name="filtro" id="filtro" value="" class="form-control form-control-sm" >
                  <option value="0">Proveedores Inactivos</option>
                  <option value="1">Proveedores Activos</option>
                  <option selected value="2">Todos los Proveedores</option>
                </select>
              </div>
          </div>
            <table id="example1" class="table table-responsive-xl table-bordered table-sm table-hover table-striped">
                <thead>
                    <tr>
                      <th width="5%"></th>
                      <th width="15%">Nombre</th>
                      <th width="10%">Paterno</th>
                      <th width="10%">Materno</th>
                      <th width="20%">Direccion</th>
                      <th width="10%">Telefono</th>
                      <th width="25%">correo</th>
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
      <div class="tab-pane" id="ProveedorEmpresa">
        <div class="card {{ config('adminlte.classes_index', '') }}">
          <div class="card-header">
          <h3 class="card-title {{ config('adminlte.classes_index_header', '') }}">LISTA DE EMPRESAS</h3>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-sm-2">
                <select  name="filtro2" id="filtro2" value="" class="form-control form-control-sm" >
                  <option value="0">Proveedores Inactivos</option>
                  <option value="1">Proveedores Activos</option>
                  <option selected value="2">Todos los Proveedores</option>
                </select>
              </div>
          </div>
            <table id="example2" class="table table-responsive-xl table-bordered table-sm table-hover table-striped">
                <thead>
                    <tr>
                      <th width="5%"></th>
                      <th width="30%">Razon Social</th>
                      <th width="20%">Direccion</th>
                      <th width="10%">Telefono</th>
                      <th width="25%">correo</th>
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
      <div class="tab-pane" id="ProveedorAgregar">
          <div class="card {{ config('adminlte.classes_index', '') }}">
              <div class="card-header">
              <h3 class="card-title  {{ config('adminlte.classes_index_header', '') }}">AGREGAR PROVEEDOR</h3>
              </div>
              <form  id="miform" name="miform" method="POST" novalidate="novalidate">
                  @csrf
                  <div class="card-body">
                      
                          <div class="row">
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="telefono" >Telefono</label>
                                      <input type="number" name="telefono" class="form-control" id="telefono" placeholder="escriba su nro telefono" aria-describedby="telefono-error" aria-invalid="true" >
                                      <span id="telefono-error" class="error invalid-feedback" style="display: none;"></span>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="direccion">Direccion</label>
                                      <input type="text" name="direccion" class="form-control" id="direccion" placeholder="ingrese su direccion" aria-describedby="direccion-error" aria-invalid="true">
                                      <span id="direccion-error" class="error invalid-feedback" style="display: none;"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="tipo_proveedor" >tipo proveedor</label>
                                      <select class="form-control" name="tipo_proveedor" id="tipo_proveedor" aria-describedby="tipo_proveedor-error" aria-invalid="true">
                                          <option selected disabled value="0">Seleccione un tipo</option>
                                          <option value="1">Persona</option>
                                          <option value="2">Empresa</option>
                                      </select>
                                      <span id="tipo_proveedor-error" class="error invalid-feedback" style="display: none;"></span>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="correo">Correo</label>
                                    <input type="email" name="correo" class="form-control" id="correo" placeholder="ingrese su correo" aria-describedby="correo-error" aria-invalid="true">
                                    <span id="correo-error" class="error invalid-feedback" style="display: none;"></span>
                                </div>
                            </div>
                          </div>
                          <div id="persona" name="persona" class="row" style="display: none" >
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="ingrese su nombre" aria-describedby="nombre-error" aria-invalid="true">
                                <span id="nombre-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                  <label for="paterno">Paterno</label>
                                  <input type="text" name="paterno" class="form-control" id="paterno" placeholder="ingrese su apellido paterno" aria-describedby="paterno-error" aria-invalid="true">
                                  <span id="paterno-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                  <label for="materno">Materno</label>
                                  <input type="text" name="materno" class="form-control" id="materno" placeholder="ingrese su apellido materno" aria-describedby="materno-error" aria-invalid="true">
                                  <span id="materno-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                            </div>
                          </div>
                          <div id="empresa" name="empresa" class="row" style="display: none">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="razon_social">Razon Social</label>
                                <input type="text" name="razon_social" class="form-control" id="razon_social" placeholder="ingrese la razon social de la empresa" aria-describedby="razon_social-error" aria-invalid="true">
                                <span id="razon_social-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label for="customFile">Previsualizar imagen</label>
                                    <div class="row col-sm-6">
                                        <img id="blah" class="img-fluid" src="{{asset('imagenes/150x150.png')}}" alt="Photo" style="max-height: 160px;">
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="row" >
                            <div class="col-sm-6">
                              <div class="custom-file">
                                <div class="form-group" >
                                  <input style="cursor: pointer;" type="file" id="img_foto" name="img_foto" class="custom-file-input" aria-describedby="img_foto-error" aria-invalid="true" accept="image/jpeg,jpg,png" >
                                  <span id="img_foto" class="error invalid-feedback" style="display: none;"></span>
                                  <label class="custom-file-label align-middle" for="img_perfil" data-browse="Buscar">Seleccione una foto</label>
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


<div class="modal fade" id="modal-editar-persona" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="card {{ config('adminlte.classes_modal', '') }}">
          <div class="card-header">
          <h3 class="card-title {{ config('adminlte.classes_modal_header', '') }}">Datos Actuales</h3>
          </div>
          <form  id="miform_editar_persona" name="miform_editar_persona"  method="POST" novalidate="novalidate">
              @csrf
              <input type="hidden" name="id_edit_persona" id="id_edit_persona" value="">
              <div class="card-body">
                      <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="telefono_modal_persona">Telefono</label>
                                  <input type="number" name="telefono_modal_persona" class="form-control" id="telefono_modal_persona" placeholder="escriba su nro telefono" aria-describedby="telefono_modal_persona-error" aria-invalid="true" >
                                  <span id="telefono_modal_persona-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="direccion_modal_persona">Direccion</label>
                                  <input type="text" name="direccion_modal_persona" class="form-control" id="direccion_modal_persona" placeholder="ingrese su direccion" aria-describedby="direccion_modal_persona-error" aria-invalid="true">
                                  <span id="direccion_modal_persona-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="tipo_proveedor_modal_persona">tipo proveedor</label>
                                  <select disabled class="form-control" name="tipo_proveedor_modal_persona" id="tipo_proveedor_modal_persona" aria-describedby="tipo_proveedor_modal_persona-error" aria-invalid="true">
                                      <option selected value="1">Persona</option>
                                      <option value="2">Empresa</option>
                                  </select>
                                  <span id="tipo_proveedor_modal_persona-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label for="correo_modal_persona">Correo</label>
                                <input type="email" name="correo_modal_persona" class="form-control" id="correo_modal_persona" placeholder="ingrese su correo" aria-describedby="correo_modal_persona-error" aria-invalid="true">
                                <span id="correo_modal_persona-error" class="error invalid-feedback" style="display: none;"></span>
                            </div>
                        </div>
                      </div>
                      <div  class="row" >
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="nombre_modal_persona">Nombre</label>
                            <input type="text" name="nombre_modal_persona" class="form-control" id="nombre_modal_persona" placeholder="ingrese su nombre" aria-describedby="nombre_modal_persona-error" aria-invalid="true">
                            <span id="nombre_modal_persona-error" class="error invalid-feedback" style="display: none;"></span>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="paterno_modal_persona">Paterno</label>
                              <input type="text" name="paterno_modal_persona" class="form-control" id="paterno_modal_persona" placeholder="ingrese su apellido paterno" aria-describedby="paterno_modal_persona-error" aria-invalid="true">
                              <span id="paterno_modal_persona-error" class="error invalid-feedback" style="display: none;"></span>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="materno_modal_persona">Materno</label>
                              <input type="text" name="materno_modal_persona" class="form-control" id="materno_modal_persona" placeholder="ingrese su apellido materno" aria-describedby="materno_modal_persona-error" aria-invalid="true">
                              <span id="materno_modal_persona-error" class="error invalid-feedback" style="display: none;"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="customFile">Previsualizar imagen</label>
                                <div class="row col-sm-6">
                                    <img id="blah_persona" class="img-fluid" src="{{asset('imagenes/proveedores/150x150.png')}}" alt="Photo" style="max-height: 160px;">
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="row" >
                        <div class="col-sm-6">
                          <div class="custom-file">
                            <div class="form-group" >
                              <input style="cursor: pointer;" type="file" id="img_foto_modal_persona" name="img_foto_modal_persona" class="custom-file-input" aria-describedby="img_foto_modal_persona-error" aria-invalid="true" accept="image/jpeg,jpg,png" >
                              <span id="img_foto_modal_persona" class="error invalid-feedback" style="display: none;"></span>
                              <label class="custom-file-label align-middle" for="img_foto_modal_persona" data-browse="Buscar">Seleccione una foto</label>
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


<div class="modal fade" id="modal-editar-empresa" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="card {{ config('adminlte.classes_modal', '') }}">
          <div class="card-header">
          <h3 class="card-title  {{ config('adminlte.classes_modal_header', '') }}">Datos Actuales</h3>
          </div>
          <form  id="miform_editar_empresa" name="miform_editar_empresa" method="POST" novalidate="novalidate">
              @csrf
              <input type="hidden" name="id_edit_empresa" id="id_edit_empresa" value="">
              <div class="card-body">
                      <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="telefono_modal_empresa">Telefono</label>
                                  <input type="number" name="telefono_modal_empresa" class="form-control" id="telefono_modal_empresa" placeholder="escriba su nro telefono" aria-describedby="telefono_modal_empresa-error" aria-invalid="true" >
                                  <span id="telefono_modal_empresa-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="direccion_modal_empresa">Direccion</label>
                                  <input type="text" name="direccion_modal_empresa" class="form-control" id="direccion_modal_empresa" placeholder="ingrese su direccion" aria-describedby="direccion_modal_empresa-error" aria-invalid="true">
                                  <span id="direccion_modal_empresa-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="tipo_proveedor_modal_empresa">tipo proveedor</label>
                                  <select disabled class="form-control" name="tipo_proveedor_modal_empresa" id="tipo_proveedor_modal_empresa" aria-describedby="tipo_proveedor_modal_empresa-error" aria-invalid="true">
                                      <option  value="1">Persona</option>
                                      <option selected value="2">Empresa</option>
                                  </select>
                                  <span id="tipo_proveedor_modal_empresa-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label for="correo_modal_empresa">Correo</label>
                                <input type="email" name="correo_modal_empresa" class="form-control" id="correo_modal_empresa" placeholder="ingrese su correo" aria-describedby="correo_modal_empresa-error" aria-invalid="true">
                                <span id="correo_modal_empresa-error" class="error invalid-feedback" style="display: none;"></span>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="razon_social_modal_empresa">Razon Social</label>
                            <input type="text" name="razon_social_modal_empresa" class="form-control" id="razon_social_modal_empresa" placeholder="ingrese la razon social de la empresa" aria-describedby="razon_social_modal_empresa-error" aria-invalid="true">
                            <span id="razon_social_modal_empresa-error" class="error invalid-feedback" style="display: none;"></span>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          
                        </div>
                      </div> 
                      <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="customFile">Previsualizar imagen</label>
                                <div class="row col-sm-6">
                                    <img id="blah_empresa" class="img-fluid" src="{{asset('imagenes/proveedores/150x150.png')}}" alt="Photo" style="max-height: 160px;">
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="row" >
                        <div class="col-sm-6">
                          <div class="custom-file">
                            <div class="form-group" >
                              <input style="cursor: pointer;" type="file" id="img_foto_modal_empresa" name="img_foto_modal_empresa" class="custom-file-input" aria-describedby="img_foto_modal_empresa-error" aria-invalid="true" accept="image/jpeg,jpg,png" >
                              <span id="img_foto_modal_empresa" class="error invalid-feedback" style="display: none;"></span>
                              <label class="custom-file-label align-middle" for="img_foto_modal_empresa" data-browse="Buscar">Seleccione una foto</label>
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
    <!-- /.modal-content -->
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

  Activo('#example1') // con que index va iniciar
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
  Inactivo('#example2');
  $('#filtro2').change(function (e) { 
    if($(this).val()==0){
     // $('#example1').DataTable().search( ':inactivo' ).draw();
     $('#example2').DataTable().column(5).search(': inactivo', true, false, true).draw();
    }
    if($(this).val()==1){
     $('#example2').DataTable().column(5).search(': activo', true, false, true).draw();
    }
    if($(this).val()==2){
     $('#example2').DataTable().column(5).search(':', true, false, true).draw();
    }
  });
  ////////

  function Activo(tabla){   
        $(tabla).DataTable({ 
          destroy: true,
          retrieve: true,
          serverSide: true,
          autoWidth: false,
          responsive: true,
          ajax: "{{route('proveedor.DatosServerSideActivo')}}",
          dataType: 'json',
          type: "POST",
          columns: [
            {data: 'foto',searchable: false,orderable: false},
            {data: 'nombre'},
            {data: 'paterno'},
            {data: 'materno'},
            {data: 'direccion'},
            {data: 'telefono'},
            {data: 'correo'},
            {data: 'estado',searchable: true,orderable: true},
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
          ajax: "{{route('proveedor.DatosServerSideInactivo')}}",
          dataType: 'json',
          type: "POST",
          columns: [
            {data: 'foto',searchable: false,orderable: false},
            {data: 'razon_social'},
            {data: 'direccion'},
            {data: 'telefono'},
            {data: 'correo'},
            {data: 'estado',searchable: true,orderable: true},
            {data: 'actions',searchable: false,orderable: false}
        ],
      })
  };

  function recarga(){
     $('#example1').DataTable().ajax.reload();
     $("#example2").DataTable().ajax.reload();
  };  
 
  //guardar 
  $('#miform').submit(function(e){
      e.preventDefault();
      var link="{{route('proveedor.store')}}";
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#miform')[0]),    
          success:function(response){
            if (response.error==1){
               // toastr.error(response.mensaje, 'Guardar Registro', {timeOut:7000})
               toastr.error("revice sus errores por favor", 'Guardar Registro', {timeOut:4000});
               }else{
                  toastr.success('El registro fue guardado correctamente.', 'Guardar Registro', {timeOut:3000}) 
                  recarga();
                  removeClass();
                  limpiarFormulario();  
               }
          }
      })
    
  });

  function Modificar(id){
    $.ajax({
        url:"{{asset('')}}"+"proveedor/buscar/"+id, dataType:'json',
        success: function(resultado){
          var id=resultado.proveedor.id;
          if (resultado.proveedor.tipo==1){  
            document.getElementById("miform_editar_persona").reset(); // limpiar todo el formmulario
            //padre
            $("#id_edit_persona").val(id);
            $("#correo_modal_persona").val(resultado.proveedor.correo);
            $("#telefono_modal_persona").val(resultado.proveedor.telefono);
            $("#direccion_modal_persona").val(resultado.proveedor.direccion);
            //hija persona
            $("#materno_modal_persona").val(resultado.proveedor_tipo.materno);
            $("#paterno_modal_persona").val(resultado.proveedor_tipo.paterno);
            $("#nombre_modal_persona").val(resultado.proveedor_tipo.nombre);
            $("#blah_persona").attr("src",resultado.url_foto);
            removeClassEditarPersona();
            $('#modal-editar-persona').modal('show'); // abrir el modal
          }
          if (resultado.proveedor.tipo==2){
            document.getElementById("miform_editar_empresa").reset(); // limpiar todo el formmulario
            //padre
            $("#id_edit_empresa").val(id);
            $("#correo_modal_empresa").val(resultado.proveedor.correo);
            $("#telefono_modal_empresa").val(resultado.proveedor.telefono);
            $("#direccion_modal_empresa").val(resultado.proveedor.direccion);
            //hija empresa
            $("#razon_social_modal_empresa").val(resultado.proveedor_tipo.razon_social);
            $("#blah_empresa").attr("src",resultado.url_foto);
            removeClassEditarEmpresa();
            $('#modal-editar-empresa').modal('show'); // abrir el modal
          }
        }
    });         
  };
  //ACTUALIZAR UN REGISTRO
  $('#miform_editar_empresa').submit(function(e){
      e.preventDefault();
      var id = $("#id_edit_empresa").val();
      var link="{{asset('')}}"+"proveedor/update/"+id;
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#miform_editar_empresa')[0]), 
          success:function(response){
              if(response.error==1){
                //toastr.error(response.mensaje, 'Actualizar Registro', {timeOut:3000}) 
                toastr.error("revice sus errores por favor", 'Guardar Registro', {timeOut:4000});
              }else{
                  toastr.success('El registro fue actualizado correctamente.', 'Actualizar Registro', {timeOut:3000}) 
                  $('#modal-editar-empresa').modal('hide'); // salir modal
                  recarga();       
              }
          }
      })
    
  });
  $('#miform_editar_persona').submit(function(e){
      e.preventDefault();
      var id = $("#id_edit_persona").val(); // id usuario
      var link="{{asset('')}}"+"proveedor/update/"+id;
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#miform_editar_persona')[0]), 
          success:function(response){
              if(response.error==1){
               // toastr.error(response.mensaje, 'Actualizar Registro', {timeOut:3000}) 
               toastr.error("revice sus errores por favor", 'Guardar Registro', {timeOut:4000});
              }else{
                  toastr.success('El registro fue actualizado correctamente.', 'Actualizar Registro', {timeOut:3000}) 
                  $('#modal-editar-persona').modal('hide'); // salir modal
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
    var link="{{asset('')}}"+"proveedor/destroy/"+id;
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
    var link="{{asset('')}}"+"proveedor/restore/"+id;
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
          telefono: {
            required: true,
          },
          direccion: {
            required: true,
          },
          correo: {
            required: true,
            email:true,
          },
          tipo_proveedor: {
            required: true,
          },
          nombre: {
            required: true,
          },
          paterno: {
            required: true,
          },
          materno: {
            required: true,
          },
          razon_social: {
            required: true,
          },
          img_foto:{
            required:false,
          }
        },
        messages: {
          telefono: {
            required: "Por favor, introduzca su numero de telefono ",
          },
          direccion: {
            required: "Por favor, introduzca su direccion",
           
          },
          correo: {
            required: "Por favor, introduzca su correo",
            email: "Por favor, requiere ser un correo valido",
          },
          tipo_proveedor: {
            required: "Por favor, seleccione un tipo de proveedor",
          },
          nombre: {
            required: "Por favor, introduzca su nombre",
          },
          paterno: {
            required: "Por favor, introduzca su apellido paterno",
          },
          materno: {
            required: "Por favor, introduzca su apellido materno",
          },
          razon_social: {
            required: "Por favor, introduzca una razon social para la empresa",
          },
          img_foto: {
            required: "Por favor, seleccione una imagen",
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
    ///////////////////
    $('#tipo_proveedor').change(function (e) {
        if ($(this).val()==1) {
            document.getElementById("persona").style.display = "block";
            document.getElementById("persona").style.display = "";
            document.getElementById("empresa").style.display = "none";
            document.getElementById("razon_social").value = "ninguno";
            document.getElementById("nombre").value = "";
            document.getElementById("paterno").value = "";
            document.getElementById("materno").value = "";   
        }
        if($(this).val()==2){
            document.getElementById("persona").style.display = "none";
            document.getElementById("empresa").style.display = "block"; // cargar
            document.getElementById("empresa").style.display = "";      // sacar stilo
            document.getElementById("nombre").value = "ninguno";
            document.getElementById("paterno").value = "ninguno";
            document.getElementById("materno").value = "ninguno";
            document.getElementById("razon_social").value = "";
        }
        if($(this).val()==0){
          document.getElementById("empresa").style.display = "none";
          document.getElementById("persona").style.display = "none";
        }
        
    })

    function removeClass(){
      document.getElementById("blah").src= "{{asset('imagenes/proveedores/150x150.png')}}";
      document.getElementById("persona").style.display = "none";
      document.getElementById("empresa").style.display = "none";
      $("#telefono").removeClass(["is-valid","is-invalid"]);
      $("#direccion").removeClass(["is-valid","is-invalid"]);
      $("#correo").removeClass(["is-valid","is-invalid"]);
      $("#tipo_proveedor").removeClass(["is-valid","is-invalid"]);
      $("#razon_social").removeClass(["is-valid","is-invalid"]);
      $("#img_foto").removeClass(["is-valid","is-invalid"]);
      $("#paterno").removeClass(["is-valid","is-invalid"]);
      $("#materno").removeClass(["is-valid","is-invalid"]);
      $("#nombre").removeClass(["is-valid","is-invalid"]);
    }

    function removeClassEditarPersona(){
      $("#telefono_modal_persona").removeClass(["is-valid","is-invalid"]);
      $("#direccion_modal_persona").removeClass(["is-valid","is-invalid"]);
      $("#correo_modal_persona").removeClass(["is-valid","is-invalid"]);
      $("#img_foto_modal_persona").removeClass(["is-valid","is-invalid"]);
      $("#paterno_modal_persona").removeClass(["is-valid","is-invalid"]);
      $("#materno_modal_persona").removeClass(["is-valid","is-invalid"]);
      $("#nombre_modal_persona").removeClass(["is-valid","is-invalid"]);
    }
    function removeClassEditarEmpresa(){
      $("#telefono_modal_empresa").removeClass(["is-valid","is-invalid"]);
      $("#direccion_modal_empresa").removeClass(["is-valid","is-invalid"]);
      $("#correo_modal_empresa").removeClass(["is-valid","is-invalid"]);
      $("#img_foto_modal_empresa").removeClass(["is-valid","is-invalid"]);
      $("#razon_social_modal_empresa").removeClass(["is-valid","is-invalid"]);
    }

    /////// edicion validacion
    $('#miform_editar_persona').validate({
        rules: {
          telefono_modal_persona: {
            required: true,
          },
          direccion_modal_persona: {
            required: true,
          },
          correo_modal_persona: {
            required: true,
            email:true,
          },
          nombre_modal_persona: {
            required: true,
          },
          paterno_modal_persona: {
            required: true,
          },
          materno_modal_persona: {
            required: true,
          }
        },
        messages: {
          telefono_modal_persona: {
            required: "Por favor, introduzca su numero de telefono ",
          },
          direccion_modal_persona: {
            required: "Por favor, introduzca su direccion",
           
          },
          correo_modal_persona: {
            required: "Por favor, introduzca su correo",
            email: "Por favor, requiere ser un correo valido",
          },
          nombre_modal_persona: {
            required: "Por favor, introduzca su nombre",
          },
          paterno_modal_persona: {
            required: "Por favor, introduzca su apellido paterno",
          },
          materno_modal_persona: {
            required: "Por favor, introduzca su apellido materno",
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

    //
    $('#miform_editar_empresa').validate({
        rules: {
          telefono_modal_empresa: {
            required: true,
          },
          direccion_modal_empresa: {
            required: true,
          },
          correo_modal_empresa: {
            required: true,
            email:true,
          },
          razon_social_modal_empresa: {
            required: true,
          }
        },
        messages: {
          telefono_modal_empresa: {
            required: "Por favor, introduzca su numero de telefono ",
          },
          direccion_modal_empresa: {
            required: "Por favor, introduzca su direccion",
           
          },
          correo_modal_empresa: {
            required: "Por favor, introduzca su correo",
            email: "Por favor, requiere ser un correo valido",
          },
          razon_social_modal_empresa: {
            required: "Por favor, introduzca su razon social",
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

    function readImagePersonal (input,campo) {
            if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(campo).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            }
    };
    ///
    $("#img_foto_modal_empresa").change(function () {
        readImagePersonal(this,"#blah_empresa");
    });
    $("#img_foto_modal_persona").change(function () {
        readImagePersonal(this,"#blah_persona");
    });
   
   

</script>

@stop
