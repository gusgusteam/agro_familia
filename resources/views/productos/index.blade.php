@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Productos</h1>   
@stop
@section('content')
  <ul class="nav nav-pills nav-tabs mb-3 justify-content-center">
    <li class="nav-item" ><a class="nav-link active"  href="#Producto"  data-toggle="tab"><i class="far fa-address-card"></i>&nbsp;&nbsp;Productos</a></li>
    <li class="nav-item" ><a class="nav-link"  onclick="limpiarFormulario()" href="#ProductoAgregar" data-toggle="tab"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a></li>
    {{--<li class="nav-item"><a class="nav-link"    href="#ProveedorEliminados"  data-toggle="tab"><i class="far fa-building"></i>&nbsp;&nbsp;</a></li>--}}             
  </ul>
  <div class="tab-content">
      <div class="active tab-pane" id="Producto">
        <div class="card {{ config('adminlte.classes_index', '') }}">
          <div class="card-header">
          <h3 class="card-title  {{ config('adminlte.classes_index_header', '') }}">LISTA DE PRODUCTOS</h3>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-sm-2">
                <select  name="filtro" id="filtro" value="" class="form-control form-control-sm" >
                  <option value="0">Productos Inactivos</option>
                  <option value="1">Productos Activos</option>
                  <option selected value="2">Todos los productos</option>
                </select>
              </div>
            </div>
            <table id="example1" class="table table-responsive-xl table-bordered table-sm table-hover table-striped">
                <thead>
                    <tr>
                      <th width="5%"></th>
                      <th width="10%">Nombre</th>
                      <th width="25%">Descripcion</th>
                      <th width="10%">Origen</th>
                      <th width="10%">Precio Compra</th>
                      <th width="10%">Precio Venta</th>
                      <th width="5%">Stock</th>
                      <th width="10%">Tipo</th>
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
      <div class="tab-pane" id="ProductoAgregar">
          <div class="card {{ config('adminlte.classes_index', '') }}">
              <div class="card-header">
              <h3 class="card-title {{ config('adminlte.classes_index_header', '') }}">AGREGAR PRODUCTO</h3>
              </div>
              <form  id="miform" name="miform" method="POST" novalidate="novalidate">
                  @csrf
                  <div class="card-body">
                          <div class="row">
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="nombre" >Nombre</label>
                                      <input type="text" name="nombre" class="form-control" id="nombre" placeholder="ingrese el nombre del producto" aria-describedby="nombre-error" aria-invalid="true" >
                                      <span id="nombre-error" class="error invalid-feedback" style="display: none;"></span>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="descripcion">Descripcion</label>
                                      <textarea type="text" name="descripcion" class="form-control" id="descripcion" placeholder="ingrese su descripcion" aria-describedby="descripcion-error" aria-invalid="true"></textarea>
                                      <span id="descripcion-error" class="error invalid-feedback" style="display: none;"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="stock_minimo">Stock Minimo</label>
                                  <input type="number" name="stock_minimo" class="form-control" id="stock_minimo" placeholder="ingrese el stock minimo" aria-describedby="stock_minimo-error" aria-invalid="true">
                                  <span id="stock_minimo-error" class="error invalid-feedback" style="display: none;"></span>
                                </div>
                              </div>
                              <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" name="stock" class="form-control" id="stock" value="0" disabled placeholder="" aria-describedby="stock-error" aria-invalid="true">
                                    <span id="stock-error" class="error invalid-feedback" style="display: none;"></span>
                                </div>
                              </div>
                              <div class="col-sm-2">

                              </div>
                              <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="precio_compra">Precio Compra</label>
                                    <input type="number" step="any" name="precio_compra" class="form-control" id="precio_compra" placeholder="ingrese su precio compra" aria-describedby="precio_compra-error" aria-invalid="true">
                                    <span id="precio_compra-error" class="error invalid-feedback" style="display: none;"></span>
                                </div>
                              </div>
                              <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="precio_venta">Precio Venta</label>
                                    <input type="number" step="any" name="precio_venta" class="form-control" id="precio_venta" placeholder="ingrese su precio venta" aria-describedby="precio_venta-error" aria-invalid="true">
                                    <span id="precio_venta-error" class="error invalid-feedback" style="display: none;"></span>
                                </div>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-3">
                              <div class="form-group">
                                  <label for="origen">Origen</label>
                                  <select class="form-control" name="origen" id="origen" aria-describedby="origen-error" aria-invalid="true">
                                      <option selected disabled value="desconocido">Seleccione su origen</option>
                                      <option value="Boliviano">Boliviano</option>
                                      <option value="Brazilero">Brazilero</option>
                                      <option value="Argentino">Argentino</option>
                                      <option value="Desconocido">Desconocido</option>
                                  </select>
                                  <span id="origen-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                  <label for="tipo_producto">Tipo Producto</label>
                                  <select class="form-control" name="tipo_producto" id="tipo_producto" aria-describedby="tipo_producto-error" aria-invalid="true">
                                      <option selected disabled value="0">Seleccione el tipo de producto</option>
                                      <option value="1">Herbicida</option>
                                      <option value="2">fertilizante</option>
                                      <option value="3">abono</option>
                                  </select>
                                  <span id="tipo_producto-error" class="error invalid-feedback" style="display: none;"></span>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="id_proveedor">Seleccione al proveedor</label>
                                <select class="form-control" name="id_proveedor" id="id_proveedor" aria-describedby="id_proveedor-error" aria-invalid="true">
                                    <option selected disabled value="0">Seleccione el proveedor</option>
                                    
                                </select>
                                <span id="id_proveedor-error" class="error invalid-feedback" style="display: none;"></span>
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


<div class="modal fade" id="modal-editar-producto" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="card {{ config('adminlte.classes_modal', '') }}">
          <div class="card-header">
          <h3 class="card-title  {{ config('adminlte.classes_modal_header', '') }}">Datos Actuales</h3>
          </div>
          <form  id="miform_editar_producto" name="miform_editar_producto"  method="POST" novalidate="novalidate">
              @csrf
              <input type="hidden" name="id_edit_producto" id="id_edit_producto" value="">
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nombre_modal_producto" >Nombre</label>
                            <input type="text" name="nombre_modal_producto" class="form-control" id="nombre_modal_producto" placeholder="ingrese el nombre del producto" aria-describedby="nombre_modal_producto-error" aria-invalid="true" >
                            <span id="nombre_modal_producto-error" class="error invalid-feedback" style="display: none;"></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="descripcion_modal_producto">Descripcion</label>
                            <textarea type="text" name="descripcion_modal_producto" class="form-control" id="descripcion_modal_producto" placeholder="ingrese su descripcion" aria-describedby="descripcion_modal_producto-error" aria-invalid="true"></textarea>
                            <span id="descripcion_modal_producto-error" class="error invalid-feedback" style="display: none;"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="stock_minimo_modal_producto">Stock Minimo</label>
                        <input type="number" name="stock_minimo_modal_producto" class="form-control" id="stock_minimo_modal_producto" placeholder="" aria-describedby="stock_minimo_modal_producto-error" aria-invalid="true">
                        <span id="stock_minimo_modal_producto-error" class="error invalid-feedback" style="display: none;"></span>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                          <label for="stock_modal_producto">Stock</label>
                          <input type="number" name="stock_modal_producto" class="form-control" id="stock_modal_producto" value="0" disabled placeholder="" aria-describedby="stock_modal_producto-error" aria-invalid="true">
                          <span id="stock_modal_producto-error" class="error invalid-feedback" style="display: none;"></span>
                      </div>
                    </div>
                    <div class="col-sm-2">

                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                          <label for="precio_compra_modal_producto">Precio Compra</label>
                          <input type="number" step="any" name="precio_compra_modal_producto" class="form-control" id="precio_compra_modal_producto" placeholder="" aria-describedby="precio_compra_modal_producto-error" aria-invalid="true">
                          <span id="precio_compra_modal_producto-error" class="error invalid-feedback" style="display: none;"></span>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                          <label for="precio_venta_modal_producto">Precio Venta</label>
                          <input type="number" step="any" name="precio_venta_modal_producto" class="form-control" id="precio_venta_modal_producto" placeholder="" aria-describedby="precio_venta_modal_producto-error" aria-invalid="true">
                          <span id="precio_venta_modal_producto-error" class="error invalid-feedback" style="display: none;"></span>
                      </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                        <label for="origen_modal_producto">Origen</label>
                        <select class="form-control" name="origen_modal_producto" id="origen_modal_producto" aria-describedby="origen_modal_producto-error" aria-invalid="true">
                            <option selected disabled value="desconocido">Seleccione su origen</option>
                            <option value="Boliviano">Boliviano</option>
                            <option value="Brazilero">Brazilero</option>
                            <option value="Argentino">Argentino</option>
                            <option value="Desconocido">Desconocido</option>
                        </select>
                        <span id="origen_modal_producto-error" class="error invalid-feedback" style="display: none;"></span>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                        <label for="tipo_producto_modal_producto">Tipo Producto</label>
                        <select class="form-control" name="tipo_producto_modal_producto" id="tipo_producto_modal_producto" aria-describedby="tipo_producto_modal_producto-error" aria-invalid="true">
                            
                        </select>
                        <span id="tipo_producto_modal_producto-error" class="error invalid-feedback" style="display: none;"></span>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="id_proveedor_modal_producto">Seleccione al proveedor</label>
                      <select class="form-control" name="id_proveedor_modal_producto" id="id_proveedor_modal_producto" aria-describedby="id_proveedor_modal_producto-error" aria-invalid="true">
                          <option selected disabled value="0">Seleccione el proveedor</option>
                      </select>
                      <span id="id_proveedor_modal_producto-error" class="error invalid-feedback" style="display: none;"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                      <label for="customFile">Previsualizar imagen</label>
                          <div class="row col-sm-6">
                              <img id="blah_producto" class="img-fluid" src="{{asset('imagenes/productos/150x150.png')}}" alt="Photo" style="max-height: 160px;">
                          </div>
                      </div>
                  </div>
                </div>
                <div class="row" >
                  <div class="col-sm-6">
                    <div class="custom-file">
                      <div class="form-group" >
                        <input style="cursor: pointer;" type="file" id="img_foto_modal_producto" name="img_foto_modal_producto" class="custom-file-input" aria-describedby="img_foto_modal_producto-error" aria-invalid="true" accept="image/png" >
                        <span id="img_foto_modal_producto" class="error invalid-feedback" style="display: none;"></span>
                        <label class="custom-file-label align-middle" for="img_foto_modal_producto" data-browse="Buscar">Seleccione una foto</label>
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
  selecctores();
  $('#filtro').change(function (e) { 
    if($(this).val()==0){
     // $('#example1').DataTable().search( ':inactivo' ).draw();
     $('#example1').DataTable().column(8).search(': inactivo', true, false, true).draw();
    }
    if($(this).val()==1){
     $('#example1').DataTable().column(8).search(': activo', true, false, true).draw();
    }
    if($(this).val()==2){
     $('#example1').DataTable().column(8).search(':', true, false, true).draw();
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
          "oSearch": {"bSmart": false},
          ajax: "{{route('producto.DatosServerSideActivo')}}",
          dataType: 'json',
          type: "POST",
          columns: [
            {data: 'foto',searchable: false,orderable: false},
            {data: 'nombre'},
            {data: 'descripcion'},
            {data: 'origen'},
            {data: 'precio_compra'},
            {data: 'precio_venta'},
            {data: 'stock'},
            {data: 'nombre_tipo'},
            {data: 'estado',searchable: true},
            {data: 'actions',searchable: false,orderable: false}
          ],
      });
  };
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
            {data: 'descripcion'},
            {data: 'nombre'},
            {data: 'correo'},
            {data: 'estado',searchable: true,orderable: true},
            {data: 'actions',searchable: false,orderable: false}
        ],
      })
  };
  
  function recarga(){
    //$('#example1').DataTable().ajax.reload(null, false);
    $("#example1").DataTable().ajax.reload();
  }; 
 
  //guardar 
  $('#miform').submit(function(e){
      e.preventDefault();
      var link="{{route('producto.store')}}";
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#miform')[0]),    
          success:function(response){
            if (response.error==1){
                //toastr.error(response.mensaje, 'Guardar Registro', {timeOut:7000})
                toastr.error("revice sus errores por favor", 'Guardar Registro', {timeOut:4000});
               }else{
                  toastr.success('El registro fue guardado correctamente.', 'Guardar Registro', {timeOut:3000}); 
                  limpiarFormulario();
                  removeClass();
                  recarga(); 
               }
          }
      })
    
  });

 

  function selecctores(){
    $.ajax({ 
          url:"{{asset('')}}"+"producto/extra" , dataType:'json',
            success: function(resultado){
            ////////////colocar el array al selectd ////////////////////
           $('#id_proveedor').empty(); // limpiar antes de sobreescribir
            $('#id_proveedor').append($('<option  />', {
              text: "seleccione al proveedor del producto",
              value: 0,
              disabled:true,
              selected:true
            }));
           resultado.proveedorempresa.forEach(function(elemento, indice, array) {
              $('#id_proveedor').append($('<option  />', {
              text: ' Empresa : '+elemento.razon_social,
              value: elemento.id_proveedor,
              }));
           });
           resultado.proveedorpersona.forEach(function(elemento, indice, array) {
              $('#id_proveedor').append($('<option  />', {
              text: ' Persona : '+elemento.nombre+' '+elemento.paterno,
              value: elemento.id_proveedor,
              }));
           });
           $('#tipo_producto').empty(); // limpiar antes de sobreescribir
            $('#tipo_producto').append($('<option  />', {
              text: "seleccione el tipo de producto",
              value: 0,
              disabled:true,
              selected:true
            }));
           resultado.tipo_producto.forEach(function(elemento, indice, array) {
              $('#tipo_producto').append($('<option  />', {
              text: elemento.nombre,
              value: elemento.id,
              }));
           });
          }
    });
  };

  function selecctores_modificar(id_tipo,id_proveedor,origen){
    $.ajax({ 
          url:"{{asset('')}}"+"producto/extra" , dataType:'json',
          success: function(resultado){
            ////////////colocar el array al selectd ////////////////////
          $('#id_proveedor_modal_producto').empty(); // limpiar antes de sobreescribir
          $('#id_proveedor_modal_producto').append($('<option  />', {
            text: "seleccione al proveedor del producto",
            value: 0,
            disabled:true,
            selected:true
          }));
           resultado.proveedorempresa.forEach(function(elemento, indice, array) {
              if (elemento.id_proveedor==id_proveedor){ //seleccionar con selected
                $('#id_proveedor_modal_producto').append($('<option  />', {
                  text: 'Empresa : '+elemento.razon_social,
                  value: elemento.id_proveedor,
                  selected: true
                }));
              }else{
                $('#id_proveedor_modal_producto').append($('<option  />', {
                  text: 'Empresa : '+elemento.razon_social,
                  value: elemento.id_proveedor,
                }));
              }
           });
           resultado.proveedorpersona.forEach(function(element, indice, array) {
            if (element.id_proveedor==id_proveedor){ //seleccionar con selected
                $('#id_proveedor_modal_producto').append($('<option  />', {
                  text: 'Persona : '+element.nombre+' '+element.paterno,
                  value: element.id_proveedor,
                  selected: true
                }));
              }else{
                $('#id_proveedor_modal_producto').append($('<option  />', {
                  text: 'Persona : '+element.nombre+' '+element.paterno,
                  value: element.id_proveedor,
                }));
              }
           });
           
            $('#tipo_producto_modal_producto').empty(); // limpiar antes de sobreescribir
            $('#tipo_producto_modal_producto').append($('<option  />', {
              text: "seleccione el tipo de producto",
              value: 0,
              disabled:true,
              selected:true
            }));
            resultado.tipo_producto.forEach(function(elemento, indice, array) {
              if (elemento.id==id_tipo){ //seleccionar con selected
                $('#tipo_producto_modal_producto').append($('<option  />', {
                  text: elemento.nombre,
                  value: elemento.id,
                  selected: true
                }));
              }else{
                $('#tipo_producto_modal_producto').append($('<option  />', {
                  text: elemento.nombre,
                  value: elemento.id,
                }));
              }
            });
          }
    });
  };
  function Modificar(id){
    $.ajax({
        url:"{{asset('')}}"+"producto/buscar/"+id, dataType:'json',
        success: function(resultado){
            var id=resultado.producto.id;
            document.getElementById("miform_editar_producto").reset(); // limpiar todo el formmulario
            $("#id_edit_producto").val(id);
            $("#nombre_modal_producto").val(resultado.producto.nombre);
            $("#descripcion_modal_producto").val(resultado.producto.descripcion);
            $("#precio_venta_modal_producto").val(resultado.producto.precio_venta);
            $("#precio_compra_modal_producto").val(resultado.producto.precio_compra);
            $("#stock_minimo_modal_producto").val(resultado.producto.stock_minimo);
            $("#stock_modal_producto").val(resultado.producto.stock);
            $("#origen_modal_producto").val(resultado.producto.origen);
            removeClassEditarProducto();
            selecctores_modificar(resultado.producto.id_tipo_producto,resultado.producto.id_proveedor,resultado.producto.origen);
            $("#blah_producto").attr("src",resultado.url_foto);
            $('#modal-editar-producto').modal('show'); // abrir el modal
        }
    });         
  };
  //ACTUALIZAR UN REGISTRO
  $('#miform_editar_producto').submit(function(e){
      e.preventDefault();
      var id = $("#id_edit_producto").val();
      var link="{{asset('')}}"+"producto/update/"+id;
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#miform_editar_producto')[0]), 
          success:function(response){
              if(response.error==1){
                //toastr.error(response.mensaje, 'Actualizar Registro', {timeOut:3000}) 
                toastr.error("revice sus errores por favor", 'Guardar Registro', {timeOut:4000});
              }else{
                  toastr.success('El registro fue actualizado correctamente.', 'Actualizar Registro', {timeOut:3000}); 
                  $('#modal-editar-producto').modal('hide'); // salir modal
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
    var link="{{asset('')}}"+"producto/destroy/"+id;
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
    var link="{{asset('')}}"+"producto/restore/"+id;
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
</script>

<script type="text/javascript">
      
    $('#miform').validate({
        rules: {
          nombre: {
            required: true,
          },
          descripcion: {
            required: true,
          },
          origen: {
            required: true,
          },
          precio_venta: {
            required: true,
            min: 0
          },
          stock_minimo: {
            required: true,
            min: 1
          },
          stock: {
            required: true,
          },
          precio_compra: {
            required: true,
            min: 0
          },
          tipo_producto: {
            required: true,
          },
          id_proveedor: {
            required: true,
          },
          img_foto:{
            required:true,
          }
        },
        messages: {
          nombre: {
            required: "Por favor, introduzca su nombre ",
          },
          descripcion: {
            required: "Por favor, introduzca una descripcion clara",  
          },
          origen: {
            required: "Por favor, seleccione un origen para el producto",
          },
          precio_venta: {
            required: "Por favor, introduzca su precio de venta",
            min: "Por favor, precio mayor o igual a 0"
          },
          precio_compra: {
            required: "Por favor, introduzca su precio de compra",
            min: "Por favor, precio mayor o igual a 0"
          },
          stock: {
            required: "Por favor, introduzca su precio de venta",
          },
          stock_minimo: {
            required: "Por favor, introduzca su precio de compra",
            min: "Por favor, stock tiene que ser mayor a 0"
          },
          tipo_producto: {
            required: "Por favor, seleccione un tipo para el producto",
          },
          id_proveedor: {
            required: "Por favor, seleccione al proveedor del producto",
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

    function removeClass(){
      document.getElementById("blah").src= "{{asset('imagenes/productos/150x150.png')}}";
      $("#nombre").removeClass(["is-valid","is-invalid"]);
      $("#descripcion").removeClass(["is-valid","is-invalid"]);
      $("#stock_minimo").removeClass(["is-valid","is-invalid"]);
      $("#origen").removeClass(["is-valid","is-invalid"]);
      $("#img_foto").removeClass(["is-valid","is-invalid"]);
      $("#precio_compra").removeClass(["is-valid","is-invalid"]);
      $("#precio_venta").removeClass(["is-valid","is-invalid"]);
      $("#tipo_producto").removeClass(["is-valid","is-invalid"]);
      $("#id_proveedor").removeClass(["is-valid","is-invalid"]);
    }
    function removeClassEditarProducto(){
      document.getElementById("blah_producto").src= "{{asset('imagenes/productos/150x150.png')}}";
      $("#nombre_modal_producto").removeClass(["is-valid","is-invalid"]);
      $("#descripcion_modal_producto").removeClass(["is-valid","is-invalid"]);
      $("#stock_minimo_modal_producto").removeClass(["is-valid","is-invalid"]);
      $("#origen_modal_producto").removeClass(["is-valid","is-invalid"]);
      $("#img_foto_modal_producto").removeClass(["is-valid","is-invalid"]);
      $("#precio_compra_modal_producto").removeClass(["is-valid","is-invalid"]);
      $("#precio_venta_modal_producto").removeClass(["is-valid","is-invalid"]);
      $("#tipo_producto_modal_producto").removeClass(["is-valid","is-invalid"]);
      $("#id_proveedor_modal_producto").removeClass(["is-valid","is-invalid"]);
    }

    /////// edicion validacion
    $('#miform_editar_producto').validate({
        rules: {
          nombre_modal_producto: {
            required: true,
          },
          descripcion_modal_producto: {
            required: true,
          },
          origen_modal_producto: {
            required: true,
          },
          precio_venta_modal_producto: {
            required: true,
            min: 0
          },
          stock_minimo_modal_producto: {
            required: true,
          },
          stock_modal_producto: {
            required: true,
          },
          precio_compra_modal_producto: {
            required: true,
            min: 0
          },
          tipo_producto_modal_producto: {
            required: true,
          },
          id_proveedor_modal_producto: {
            required: true,
          },
          img_foto_modal_producto:{
            required:false,
          }
        },
        messages: {
          nombre_modal_producto: {
            required: "Por favor, introduzca su nombre ",
          },
          descripcion_modal_producto: {
            required: "Por favor, introduzca una descripcion clara",  
          },
          origen_modal_producto: {
            required: "Por favor, seleccione un origen para el producto",
          },
          precio_venta_modal_producto: {
            required: "Por favor, introduzca su precio de venta",
            min: "Por favor, precio mayor o igual a 0"
          },
          precio_compra_modal_producto: {
            required: "Por favor, introduzca su precio de compra",
            min: "Por favor, precio mayor o igual a 0"
          },
          stock_modal_producto: {
            required: "Por favor, introduzca su precio de venta",
          },
          stock_minimo_modal_producto: {
            required: "Por favor, introduzca su precio de compra",
          },
          tipo_producto_modal_producto: {
            required: "Por favor, seleccione un tipo para el producto",
          },
          id_proveedor_modal_producto: {
            required: "Por favor, seleccione al proveedor del producto",
          },
          img_foto_modal_producto: {
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

    function readImagePersonal (input,campo) {
            if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(campo).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            }
    };

    $("#img_foto_modal_producto").change(function () {
        readImagePersonal(this,"#blah_producto");
    });
   
   

</script>

@stop
