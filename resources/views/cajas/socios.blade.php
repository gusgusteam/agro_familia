@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Socios</h1>
    
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
        <div class="card-body">
            <div class="row">
                {{--
                <div class="col-sm-3">       
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-primary" id="buscador" name="buscador" ><i class="fas fa-search"></i></button>
                        </div>
                        <input class="form-control" id="nombre_user" name="nombre_user" type="text" placeholder="Escribe el nombre del usuario"  autofocus>
                    </div>  
                </div>
                --}}
                <div class="col-sm-6">
                    <form id="add" method="POST" enctype="multipart/form-data">
                        @csrf 
                        <div class="input-group mb-3">
                            <label for="usuarios_id">Registro de usuarios   <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i></button>
                            </label>
                            <input  id="id_caja" name="id_caja" type="hidden" value="{{$id_caja}}">
                            <select class="select2 select2-hidden-accessible" id="usuarios_id" name="usuarios_id[]" multiple="multiple" data-placeholder="Seleccione a los socios necesarios" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true"> 
                            </select> 
                        </div>   
                    </form> 
                </div>
                
                <div class="col-sm-6">
                    <div class="text-right">
                        <h4>{{$nombre_caja}}</h4>
                    </div>
                </div>  
            </div>
            

               
            <table id="example1" class="table table-responsive-xl table-bordered table-sm table-hover table-striped"  >
                <thead>
                    <tr>  
                        <th>nombre</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Edad</th>
                        <th>Cargo</th>
                        <th width="5%">Acción</th>
                    </tr>
                </thead>  
                <tfoot>
                </tfoot>
            </table>
            <form id="formeliminar">
                @csrf
                <input type="hidden" name="id_cajaM" id="id_cajaM">
                <input type="hidden" name="id_usuarioM" id="id_usuarioM">
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
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
</script>
<script>
 
  Activo('#example1') // con que index va iniciar

  function Activo(tabla){
    $(tabla).DataTable({ 
      destroy: true,
      retrieve: true,
      serverSide: true,
      autoWidth: false,
      responsive: true,
      cache: false,
      ajax: "{{route('caja.socio.DatosServerSideActivo',"+$id_caja+")}}",
      dataType: 'json',
      type: "POST",
      columns: [
          {data: 'name'},
          {data: 'apellidos'},
          {data: 'email' },
          {data: 'edad'},
          {data: 'cargo_tipo'},
          {data: 'actions',searchable: false,orderable: false}
      ],
    })
  }

  function recarga(){
    $('#example1').DataTable().ajax.reload();
  }


  $(document).ready(function() { 
    $.ajax({ 
        url:"{{asset('')}}"+"caja/socio/buscar/"+"1", dataType:'json',
        success: function(resultado){
          ////////////colocar el array al selectd ////////////////////
          $('#usuarios_id').empty(); // limpiar antes de sobreescribir
          resultado.user.forEach(function(elemento, indice, array) {
            $('#usuarios_id').append($('<option  />', {
            text: elemento.name + ' correo: ' + elemento.email,
            value: elemento.id,
            }));
          });
        }
    });      
  })



  $('#add').submit(function(e){
      e.preventDefault();
      var link="{{route('caja.socio.add')}}";
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#add')[0]),    
          success:function(response){
            if (response.error==1){
                toastr.error(response.mensaje, 'Guardar Registro', {timeOut:7000})
               }else{
                  toastr.success('El registro fue guardado correctamente.', 'Guardar Registro', {timeOut:3000}) 
                  recarga();
               }
          }
      });  
  });

  function Eliminar(id_caja,id_usuario){ // modal
    $("#id_usuarioM").val(id_usuario);
    $("#id_cajaM").val(id_caja);
    $('#ModalEliminar').modal('show');
  }
  // ELIMINAR UN REGISTRO
  $('#Delete').click(function(){
    var link="{{route('caja.socio.destroy')}}";
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#formeliminar')[0]),    
          success:function(response){
            if (response.error==1){
                toastr.error(response.mensaje, 'Eliminar Registro', {timeOut:7000})
               }else{
                  toastr.success('El registro fue eliminado correctamente.', 'Eliminar Registro', {timeOut:3000}) 
                  recarga();
               }
          }
      })
    $('#ModalEliminar').modal('hide'); // salir modal
  });

  </script>
@stop