@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Egresos</h1>   
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
            <div class="active tab-pane" id="Egresos">
                <table id="example1" class="table table-responsive-xl table-bordered table-sm table-hover table-striped">
                    <thead>
                        <tr>
                            <th width="5%">Foto</th>
                            <th width="11%"> caja </th>
                            <th>Descripcion</th>
                            <th width="8%">monto</th>
                            <th width="13%">fecha y hora</th>
                            <th width="15%">remitente</th>
                            <th width="5%">Acción</th>
                        </tr>
                    </thead>
                    <tfoot>
                    </tfoot>
                </table>
            </div>   
        </div>
    </div>
    
</div>

<!-- Modal -->
<div class="modal fade" id="ModalPersonal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        
        <div class="modal-header border-bottom-0">
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="text-center">
            <h5  id="exampleModalLabel">Empleados vinculados</h5>
        </div>
        <table id="personas_listas" class="table table-responsive-xl table-bordered table-sm table-hover table-striped">
            <thead>
                <tr>
                    <th width="5%" >Foto</th>
                    <th width="4%"> id </th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Nro carnet</th>
                    <th>Sueldo</th>
                   {{-- <th width="5%">Acción</th> --}}
                </tr>
            </thead>
            
        </table>
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

  Activo('#example1'); // con que index va iniciar

  function Activo(tabla){   
    $(tabla).DataTable({ 
      destroy: true,
      retrieve: true,
      serverSide: true,
      autoWidth: false,
      responsive: true,
      cache: false,
      ajax: "{{route('egreso.DatosServerSideActivo')}}",
      dataType: 'json',
      type: "POST",
      columns: [
        {data: 'foto',searchable: false,orderable: false},
        {data: 'caja_nombre',orderable: false},
        {data: 'descripcion',orderable: false},
        {data: 'monto',orderable: false},
        {data: 'fecha',orderable: false},
        {data: 'nombre_apellido',orderable: false},
        {data: 'actions',searchable: false, orderable: false} 
      ],   
    });
  }

  function Detalles(id){
    var codigo=id;    
    $('#personas_listas').DataTable({ 
        destroy: true,
        retrieve: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        cache: false,
        ajax: "{{asset('')}}"+"egreso/empleado/buscar/"+codigo,
        dataType: 'json',
        type: "POST",
        columns: [
          {data: 'foto',searchable: false,orderable: false},
          {data: 'id',orderable: true},
          {data: 'nombre',orderable: false},
          {data: 'apellidos',orderable: false},
          {data: 'direccion',orderable: false},
          {data: 'telefono',orderable: false},
          {data: 'nro_carnet',searchable: false,orderable: false},
          {data: 'sueldo',searchable: false,orderable: false}   
        ],   
      order: [[1, 'desc']],
    });
    $('#ModalPersonal').modal('show');
  }
  
  function recarga(){
    $('#example1').DataTable().ajax.reload();
  }

  

  function Marcar(id){
    $.ajax({
        
        url:"{{asset('')}}"+"egreso/marcar/"+id, dataType:'json',
        success: function(resultado){
          toastr.success(resultado, 'Registro', {timeOut:3000});
          recarga();
        }
    });         
  };
    
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