@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Ingresos y Egresos</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <div class="text-center"><h3>{{$nombre_caja}}</h3></div>
            <div class="row">
               
                <div class="col-md-4">
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-balance-scale-right"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Ingresos</span>
                      <span id="monto_ingreso" name="monto_ingreso" class="info-box-number">ninguno</span>
                      
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill-alt"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Capital</span>
                      <span id="monto_ajax" name="monto_ajax" class="info-box-number">ninguno</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-balance-scale-left"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Egresos</span>
                      <span id="monto_egreso" name="monto_egreso" class="info-box-number">ninguno</span>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-md-6">
              <div class="text-center">
                <div class="mb-3">
                  <button id="btn_ingreso" name="btn_ingreso" class="btn btn-success"><i class="fas fa-plus"> ingreso</i></button>
                </div>
              </div>
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title  w-100 text-center font-weight-bold text-light">INGRESOS</h3>    
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-responsive-xl table-bordered table-sm table-hover table-striped">
                    <thead>                  
                      <tr>
                        {{--<th width="4%">#</th>--}}
                        <th>descripcion</th>
                        <th width="7%">monto</th>
                        <th width="4%">accion</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
              <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="text-center">
                  <div class="mb-3">
                    <button id="btn_egreso" name="btn_egreso" class="btn btn-success"><i class="fas fa-plus"> egreso</i></button>
                  </div>
                </div>
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title  w-100 text-center font-weight-bold text-light">EGRESOS</h3>  
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example2" class="table table-responsive-xl table-bordered table-sm table-hover table-striped">
                      <thead>                  
                        <tr>
                            {{--<th width="4%">#</th>--}}
                            <th>descripcion</th>
                            <th width="7%">monto</th>
                            <th width="4%">accion</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
                <!-- /.card -->
              </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ModalEgreso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true" >
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header border-bottom-0">
              <h5 class="modal-title" id="exampleModalLabel">EGRESO</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="FormEgreso">
              @csrf
              <div class="modal-body ">
                <input type="hidden" class="form-control" name="id_caja_egreso" id="id_caja_egreso" value="{{$id_caja}}">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="input-group mb-3">
                      <label for="id_empleados_aux">Registro de persona </label>
                        <select class="select2 select2-hidden-accessible" id="id_empleados" name="id_empleados[]" multiple="multiple" data-placeholder="Seleccione a las personas vinculadas" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true"> 
                        
                        </select> 
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="descripcionM">Descripcion</label>
                      <textarea  class="form-control" name="descripcionM" id="descripcionM" rows=3 cols=20  placeholder="Si necesita, escriba aquí sus observaciones" > </textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="montoM">Monto <span class="badge bg-primary">bs</span></label>
                      <input type="number" step="any" class="form-control" name="montoM" id="montoM" placeholder="monto en bs">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="id_tipo">Tipo Egreso</label>
                      <select class="form-control"  id="id_tipo" name="id_tipo" required>
                        <option disabled value="">Seleccionar el tipo de egreso</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                      <label for="customFile">Previsualizar imagen</label>
                          <div class="row col-sm-6">
                              <img id="blah" class="img-fluid" src="{{asset('imagenes/egresos/150x150.png')}}" alt="Photo" style="max-height: 160px;">
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
              </div>
              <div class="modal-footer border-top-0 d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Guardar</button>
              </div>
            </form>
          </div>
        </div>
    </div>

    {{--ingresos--}}

        <!-- Modal -->
        <div class="modal fade" id="ModalIngreso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel">INGRESO</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form id="FormIngreso">
                  @csrf
                  <div class="modal-body">
                    <input type="hidden" class="form-control" name="id_caja_ingreso" id="id_caja_ingreso" value="{{$id_caja}}">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="input-group mb-3">
                          <label for="id_personas">Registro de persona  </label>
                          <select class="select2 select2-hidden-accessible" id="id_personas" name="id_personas[]" multiple="multiple" data-placeholder="Seleccione a las personas vinculadas" style="width: 100%;" data-select2-id="8" tabindex="-1" aria-hidden="true"> 
                            
                          </select> 
                        </div> 
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="descripcion2M">Descripcion</label>
                          <textarea  class="form-control" name="descripcion2M" id="descripcion2M" > </textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="montoM">Monto <span class="badge bg-primary">bs</span></label>
                          <input type="number" step="any" class="form-control" name="montoM" id="montoM" placeholder="monto en bs">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="id_tipo2">Tipo Ingreso</label>
                          <select class="form-control"  id="id_tipo2" name="id_tipo2" required>
                            <option disabled value="">Seleccionar el tipo de ingreso</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                          <label for="customFile">Previsualizar imagen</label>
                              <div class="row col-sm-6">
                                  <img id="blah2"  class="img-fluid" src="{{asset('imagenes/ingresos/150x150.png')}}" alt="Photo" style="max-height: 160px;">
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="row" >
                      <div class="col-sm-6">
                        <div class="custom-file">
                          <input style="cursor: pointer;" type="file" id="img_perfil2" name="img_perfil2" class="custom-file-input" accept="image/jpeg,jpg" >
                          <label class="custom-file-label align-middle" for="img_perfil2" data-browse="Buscar">Seleccione una foto</label>
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
@section('plugins.Sweetalert2', true)
@section('js')


<script>
 Activo('#example1'); // con que index va iniciar  Ingresos
 Inactivo('#example2');
 monto();

  function Activo(tabla){    
    $(tabla).DataTable({ 
      destroy: true,
      retrieve: true,
      serverSide: true,
      autoWidth: false,
      cache: false,
      // responsive: true,
      ajax: "{{route('caja.ingreso.DatosServerSide',"+$id_caja+")}}",
      dataType: 'json',
      type: "POST",
      columns: [
          {data: 'descripcion',orderable: false},
          {data: 'monto',orderable: false},
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
      // responsive: true,
      ajax: "{{route('caja.egreso.DatosServerSide',"+$id_caja+")}}",
      dataType: 'json',
      type: "POST",
      columns: [
        {data: 'descripcion',orderable: false},
        {data: 'monto',orderable: false},
        {data: 'actions',searchable: false,orderable: false}
      ],
    });
  }
  ///////////

  function empleados_cargar(){
    $(document).ready(function() { 
      $.ajax({ 
          url:"{{asset('')}}"+"caja/socio/buscar/"+"0", dataType:'json',
          success: function(resultado){
            ////////////colocar el array al selectd ////////////////////
            $('#id_empleados').empty(); // limpiar antes de sobreescribir
            resultado.empleado.forEach(function(elemento, indice, array) {
                  $('#id_empleados').append($('<option  />', {
                  text: elemento.nombre + ' ' + elemento.apellidos + ' CI: ' + elemento.nro_carnet,
                 // value: [elemento.id,elemento.sueldo],
                  value: elemento.id,
                  }));
            
            });
          }
      });      
    })
  }

  function personas_cargar(){
      $.ajax({ 
          url:"{{asset('')}}"+"caja/socio/buscar/"+"0", dataType:'json',
          success: function(resultado){
            ////////////colocar el array al selectd ////////////////////
            $('#id_personas').empty(); // limpiar antes de sobreescribir
            resultado.empleado.forEach(function(elemento, indice, array) {
                  $('#id_personas').append($('<option  />', {
                  text: elemento.nombre + ' ' + elemento.apellidos + ' CI: ' + elemento.nro_carnet,
                  value: elemento.id,
                  }));
            
            });
          }
      });      
  }

  /////////
  function recarga(){
    $('#example1').DataTable().ajax.reload();
  }

  function recarga2(){
    $('#example2').DataTable().ajax.reload(); 
  }
  // selector dinamico con array
  $(function () {
      //Initialize Select2 Elements
       $('.select2').select2()
      //$('#grado_academico').select2()
      //Initialize Select2 Elements 
  })

  $(document).ready(function() { 
    $.ajax({ 
        url:"{{asset('')}}"+"gestion/tipo" , dataType:'json',
        success: function(resultado){
          ////////////colocar el array al selectd ////////////////////
          $('#id_tipo').empty(); // limpiar antes de sobreescribir
          resultado.datos.forEach(function(elemento, indice, array) {
                 $('#id_tipo').append($('<option  />', {
                 text: elemento.nombre,
                 value: elemento.id,
                 }));
          
          });
          $('#id_tipo2').empty(); // limpiar antes de sobreescribir
          resultado.datos.forEach(function(elemento, indice, array) {
                 $('#id_tipo2').append($('<option  />', {
                 text: elemento.nombre,
                 value: elemento.id,
                 }));
          
          });
        }
    });      
  })

  $('#btn_egreso').click(function(){  // CARGAR 
    empleados_cargar();
    document.getElementById("FormEgreso").reset();
    document.getElementById("blah").src= "{{asset('imagenes/egresos/150x150.png')}}";
    $('#ModalEgreso').modal('show');
  });

  $('#btn_ingreso').click(function(){  // CARGAR 
    personas_cargar();
    document.getElementById("FormIngreso").reset();
    document.getElementById("blah2").src= "{{asset('imagenes/ingresos/150x150.png')}}";
    $('#ModalIngreso').modal('show');
  });

  $('#FormEgreso').submit(function(e){
      e.preventDefault();
      var link="{{route('caja.egreso.add')}}";
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#FormEgreso')[0]),    
          success:function(response){
            if (response.error==1){
                toastr.error(response.mensaje, 'Guardar Registro', {timeOut:7000})
               }else{
                  toastr.success('El registro fue guardado correctamente. ', 'Guardar Registro', {timeOut:3000}) 
                  recarga2();
                  $('#ModalEgreso').modal('hide');
                  monto();
               }
          }
      });  
      
  });

  $('#FormIngreso').submit(function(e){
      e.preventDefault();
      var link="{{route('caja.ingreso.add')}}";
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#FormIngreso')[0]),    
          success:function(response){
            if (response.error==1){
                toastr.error(response.mensaje, 'Guardar Registro', {timeOut:7000})
               }else{
                  toastr.success('El registro fue guardado correctamente.', 'Guardar Registro', {timeOut:3000}) 
                  recarga();
                  $('#ModalIngreso').modal('hide');
                  monto();  
               }
          }
      });   
  });

  
  function monto(){
    $.ajax({ 
        url:"{{asset('')}}"+"caja/monto/"+{{$id_caja}} , dataType:'json', // id de la caja {{$id_caja}}
        success: function(resultado){

          $('#monto_ingreso').empty();
          $('#monto_egreso').empty();
          $('#monto_ajax').empty();
          var ingreso= resultado.monto_ingreso + " bs";
          var egreso= resultado.monto_egreso + " bs";
          var monto= resultado.monto + " bs";
          var text = document.createTextNode(ingreso);     
          document.getElementById("monto_ingreso").appendChild(text);
          var text1 = document.createTextNode(egreso);
          document.getElementById("monto_egreso").appendChild(text1);
          var text2 = document.createTextNode(monto);
          document.getElementById("monto_ajax").appendChild(text2);

        }
    });  
  }

  function Eliminar_ingreso($id_ingreso){  
  Swal.fire({
  title: 'INGRESO',
  text: "Desea, eliminar el registro",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si '
    }).then((result) => {
        if (result.isConfirmed) {
            //////////////////////////
            var link="{{asset('')}}"+"caja/ingreso/destroy/"+$id_ingreso;
            $.ajax({
                url: link, dataType:'json',
                type: "GET",
                cache: false,
                async: false,
                success:function(resultado){
                    if(resultado.error==1){
                        toastr.error(resultado.mensaje, 'Eliminar Registro', {timeOut:3000})
                    }else{
                    toastr.success('El registro fue eliminado correctamente.', 'Eliminar Registro', {timeOut:3000})  
                    monto();
                    }            
                }
            })
            recarga();
            //////////////////////////////
        }
    }) 
  }

  function Eliminar_egreso($id_egreso){
  Swal.fire({
  title: 'EGRESO',
  text: "Desea, eliminar el registro",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si '
    }).then((result) => {
        if (result.isConfirmed) {
            /////////////////////////////////////
            var link="{{asset('')}}"+"caja/egreso/destroy/"+$id_egreso;
            $.ajax({
                url: link, dataType:'json',
                type: "GET",
                cache: false,
                async: false,
                success:function(resultado){
                    if(resultado.error==1){
                        toastr.error(resultado.mensaje, 'Eliminar Registro', {timeOut:3000})
                    }else{
                    toastr.success('El registro fue eliminado correctamente.', 'Eliminar Registro', {timeOut:3000})
                    monto();  
                    }         
                }
            })
            recarga2();
            ////////////////////////////////////
        }
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
  function readImage2 (input) {
      if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#blah2').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
      }
  }
  $("#img_perfil2").change(function () {
      readImage2(this);
  });
</script>

<script>
  $(document).ready(function () {
      $('#id_empleados_aux').change(function (e) {
        if ($(this).val()!=null) {
          llamarempleado($(this).val());
          $('#modal-lg').modal('show');
          //$('#miinput').prop("disabled", false);
          //$('#miinput').val($(this).val());
        }
      })

      $('#id_empleados').change(function (e) {
        
          
          $('#miinput').val($(this).val());
         
       
      })
  });

  function llamarempleado(id){
    $.ajax({ 
        url:"{{asset('')}}"+"empleado/buscar/"+id , dataType:'json', 
        success: function(resultado){
          $('#nombre_modal_sm').empty();
          $('#modal_id_empleado').val(id);
          var nombre= resultado.nombre +" "+ resultado.apellidos + " CI: "+resultado.nro_carnet;
          var text = document.createTextNode(nombre);     
          document.getElementById("nombre_modal_sm").appendChild(text);
        }
    });  
  }

  function cargar_select2(id,monto){
    
      $.ajax({ 
        url:"{{asset('')}}"+"empleado/buscar/"+id , dataType:'json',
          success: function(resultado){
            ////////////colocar el array al selectd ////////////////////
           // $('#id_empleados').empty(); // limpiar antes de sobreescribir
                $('#id_empleados').append($('<option   />', {
                  text: resultado.nombre + ' ' + resultado.apellidos + ' CI: ' + resultado.nro_carnet,
                  value: [resultado.id,monto],
                  selected: true,
                  disabled: true
                }));
          }
        });      
  }


</script>

<script type="text/javascript">


$('#sel1').on('change', function (e) {
    e.preventDefault();
    var selVal = $(this).val();
    var selHtml = $(this).find('option:selected').text();
    moveItem('#sel1', '#sel2', selVal, selHtml);//call our function
});
//On change of the second select
$('#sel2').on('change', function (e) {
    e.preventDefault();
    var selVal = $(this).val();
    var selHtml = $(this).find('option:selected').text();
    moveItem('#sel2', '#sel1', selVal, selHtml);//call our function
});


//Move function take 4 parameters
function moveItem(moveFrom, moveTo, selVal, selHtml) {
    if (confirm("Are you sure? : " + selVal)) {//Confirm dialogue box comes up and on selecting 'ok' this part will be executed
    var mId = moveFrom + ' option[value="' + selVal + '"]';
    $(mId).remove();//remove value from the other select    
   // $(moveTo).append('<option value="' + selVal + '">' + selHtml + '</option>');//append a value to select
    $('#id_empleados').append($('<option   />', {
      text: selHtml,
      value: [selVal,176],
      selected: true
    }));
    }
    return false;
}

</script>












<script type="text/javascript"> 
function pdf(){
  window.addEventListener("load", window.print());
}
</script>
@stop