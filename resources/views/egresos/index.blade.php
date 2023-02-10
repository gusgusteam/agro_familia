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
                            <th width="15%"> caja </th>
                            <th width="45%">Descripcion</th>
                            <th width="5%">monto</th>
                            <th width="10%">fecha y hora</th>
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
<div class="modal fade" id="ModalPersonal" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="card {{ config('adminlte.classes_modal', '') }}">
          <div class="card-header">
          <h3 class="card-title  {{ config('adminlte.classes_modal_header', '') }}">Personas Asociados</h3>
          </div>
          <div class="container">
            <table id="personas_listas" class="table table-responsive-xl table-bordered table-sm table-hover table-striped">
              <thead>
                  <tr>
                      <th width="5%" >Foto</th>
                      <th width="20%">Nombre</th>
                      <th width="20%">Apellidos</th>
                      <th width="35%">Direccion</th>
                      <th width="10%">Telefono</th>
                      <th width="10%">Nro carnet</th>
                  </tr>
              </thead>
            </table>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
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
        filter: false,
        info: false,
        lengthChange: false,
        bSort: false,
        paging: false,
        ordering: false,
        ajax: "{{asset('')}}"+"egreso/empleado/buscar/"+codigo,
        dataType: 'json',
        type: "POST",
        columns: [
          {data: 'foto',searchable: false,orderable: false},
          {data: 'nombre',orderable: false},
          {data: 'apellidos',orderable: false},
          {data: 'direccion',orderable: false},
          {data: 'telefono',orderable: false},
          {data: 'nro_carnet',searchable: false,orderable: false}    
        ],   
      order: [[1, 'desc']],
    });
    $('#ModalPersonal').modal('show');
  }
  
  function recarga_global(){
    $('#example1').DataTable().ajax.reload();
  }

  

  function Marcar(id){
    $.ajax({
        
        url:"{{asset('')}}"+"egreso/marcar/"+id, dataType:'json',
        success: function(resultado){
          toastr.success(resultado, 'Registro', {timeOut:3000});
          recarga_global();
        }
    });         
  };
    


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
