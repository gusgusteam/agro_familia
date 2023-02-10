

@extends('adminlte::page2')

@section('title','INFORME DE GESTION DE CAJA '.' '. date('y-n-d h:i:s '))

  <div class="text-center">
    <button id="prueba2" name="prueba2" onclick="pdf()" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i> IMPRIMIR INFORME </button>
    {{--<a id="prueba2" name="prueba2" class="btn btn-danger" onclick="pdf()">imprimir pdf</a>--}}
  </div>

  

<div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="text-left">
            <span> <strong>remitente :</strong> {{Auth::user()->name .' '.Auth::user()->apellidos}}</span> <br>
            <span> <strong>direccion :</strong>  San Jose Del Norte</span> <br>
            <span> <strong>fecha y hora :</strong> {{date('y-n-d h:i:s ')}}</span> <br>
            <span> <strong>gestion :</strong>    {{$nombre_gestion}}</span> <br>
          </div>
        </div>
        <div class="col-md-6">
          <div class="text-right">
            <img class="img-fluid"  src="{{asset('vendor/adminlte/dist/img/Logo.png')}}">
          </div>
        </div>
      </div>
      
      <div class="mb-3">
          <div class="text-center"><h3>{{$nombre_caja}}</h3></div>  
      </div> 
      <div class="row">
            <div class="col-md-6">
              <div class="card card-primary border">
                <div class="card-header">
                  <h3 class="card-title  w-100 text-center font-weight-bold text-light">INGRESOS</h3>
                </div>
                <div class="card-body">
                  <table id="example1" class="table  table-bordered table-sm  table-striped">
                    <thead>                  
                      <tr>
                        <th>descripcion</th>
                        <th width="7%">monto</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card card-primary border">
                <div class="card-header">
                  <h3 class="card-title  w-100 text-center font-weight-bold text-light">EGRESOS</h3>
                </div>
                <div class="card-body">
                  <table id="example2" class="table table-striped table-bordered table-sm ">
                    <thead>                  
                      <tr>
                          <th>descripcion</th>
                          <th width="7%">monto</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
      </div>
      <div class="row">
               
        <div class="col-md-4">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-balance-scale-right"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Ingresos</span>
              <span id="monto_ingreso" name="monto_ingreso" class="info-box-number">ninguno </span> 
              
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

@section('plugins.Datatables', true)

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
      filter: false,
      info: false,
      lengthChange: false,
      bSort: false,
      paging: false,
      ordering: false,
      // responsive: true,
      ajax: "{{route('caja.ingreso.DatosServerSide',"+$id_caja+")}}",
      dataType: 'json',
      type: "POST",
      columns: [
          {data: 'descripcion',orderable: false},
          {data: 'monto',orderable: false},
      ],
      aLengthMenu: [ [-1],["All"] ],
      iDisplayLength: -1
 
    });
  }
  /////////
  function Inactivo(tabla){   
    $(tabla).DataTable({ 
      destroy: true,
      retrieve: true,
      serverSide: true,
      autoWidth: false,
      filter: false,
      info: false,
      lengthChange: false,
      bSort: false,
      paging: false,
      ordering: false,
      // responsive: true,
      ajax: "{{route('caja.egreso.DatosServerSide',"+$id_caja+")}}",
      dataType: 'json',
      type: "POST",
      columns: [
        {data: 'descripcion',orderable: false},
        {data: 'monto',orderable: false},
      ],
      aLengthMenu: [ [-1],["All"] ],
      iDisplayLength: -1
    });
  }

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

</script>




<script type="text/javascript"> 
function pdf(){
 // var doc = new jsPDF();
 document.getElementById('prueba2').className="btn btn-danger invisible";
  window.addEventListener("load", window.print());

  //doc.fromHTML(window.addEventListener("load",null));
  //doc.save('conversion-html-a-pdf.pdf');
  
}

$(document).ready(function(){
    $('#getUser').on('click',function(){
      
       
            var printContent = document.getElementById('contenido');
            var WinPrint = window.open('', '', 'width=900,height=650');
            WinPrint.document.write(printContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
      
    });
});

</script>

<script>
  
  function convert_HTML_To_PDF() {
    var doc = new jsPDF();
    var elementHTML = document.getElementById('contenido');
    
    
    
    doc.fromHTML(elementHTML);
    
    // Save the PDF
    doc.save('conversion-html-a-pdf.pdf');
  }
  </script>
@stop

