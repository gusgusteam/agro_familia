@extends('adminlte::page2')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- <title>AdminLTE 3 | Top Navigation</title> --}}
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Agro Aisa</title>
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    
      <a href="{{ url('/') }}" class="navbar-brand">
        <img src="{{asset('vendor/adminlte/dist/img/Logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Agro Aisa</span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link">Panes</a>
          </li>
         
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Categorias</a>
            
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Notifications Dropdown Menu -->
        @guest
        @else
          <li class="nav-item dropdown">
            @if (Auth::user()->hasRole('Cliente') or Auth::user()->hasRole('Administrador') or Auth::user()->hasRole('Repartidor'))
              @if (Auth::user()->hasRole('Cliente'))
                <li class="nav-item">
                  <a class="nav-link"  href="#">
                    <i class="fas fa-hard-hat"> Mis pedidos</i>
                  </a>
                </li>
              @endif
              @if (Auth::user()->hasRole('Administrador'))
                <li class="nav-item"> 
                  <a class="nav-link"  href="#">
                    <i class="fas fa-chart-bar"> Administración</i>
                  </a>
                </li>
              @endif
              @if (Auth::user()->hasRole('Repartidor'))
                <li class="nav-item">
                  <a class="nav-link"  href="#">
                    <i class="fas fa-motorcycle"> Delivery</i>
                  </a>
                </li>
              @endif 
            @else
              <li class="nav-item">
                <a class="nav-link"  href="#">
                  <i class="fas fa-cash-register"> Recepcion</i>
                </a>
              </li>
            @endif
          </li>            
        @endguest

      @guest
           <!-- Iniciar Sesion -->
            <li  class="nav-item dropdown">
                <a  class="nav-link" data-toggle="dropdown" href="#">
                  <i class="fas fa-user-cog"></i>
                </a> 
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @if (Route::has('login'))
                  <div class="dropdown-divider"></div>
                  <a href="{{ route('login') }}" class="dropdown-item">
                      <i class="fas fa-sign-in-alt mr-2"></i>{{ __('Login') }}
                  </a>
                @endif
              </div>
            </li>
      @else  
   
       <!-- NAV PERFIL -->
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link" data-toggle="dropdown">
            <i class="fas fa-user-cog"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-lx dropdown-menu-right">
            <!-- User image -->
            <li class="user-header" style="background: url(#) center center;">
              <img src="{{asset('vendor/adminlte/dist/img/Logo.png')}}" class="img-circle elevation-2" alt="User Image">
              <p class="text-white">
                {{ Auth::user()->roles[0]->name  }}
                <small clasS="text-muted text-white">{{Auth::user()->name}}</small>
                <small clasS="text-muted text-white">Montero - {{date('d-m-Y');}} </small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <a href="#" class="btn btn-default btn-flat text-dark"><i class="fas fa-user mr-2"></i>Perfil</a>
              <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-default btn-flat float-right text-dark"><i class="fas fa-sign-out-alt mr-2"></i>Cerrar sesión</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form> 
            </li>
          </ul>
        </li>
         <!-- FIN DE NAV PERFIL -->
      @endguest
  
      </ul>
  
    
  </nav>

  
</div>




</body>

@section('plugins.Datatables', true)

@section('js')
<script>

  $(document).ready(function(){
  $.ajax({
        url:'{{url('')}}/carrito-leer',
        method:"GET",
        success: function(resultado){
            if (resultado == 0) {
            }
            else{
                var resultado= JSON.parse(resultado);
                if (resultado.datos) {
                  $("#ContadorCart").html(resultado.datos);
                }
            }
        }
    });
});

  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,//view nro
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "deferRender": true,//
      "retrieve": true,
      "processing": true,//
      language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "lengthMenu": "Mostrar _MENU_ entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "next": "Siguiente",
            "previous": "Anterior"
        }
      }
    });
  });

    var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
    });
    toastr.options = {
      "closeButton": true,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-bottom-left",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }


    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.swalDefaultSuccess').click(function() {
    Toast.fire({
      icon: 'success',
      title: 'Loasassascing elitr.'
    })
  });
  $('.swalDefaultInfo').click(function() {
    Toast.fire({
      icon: 'info',
      title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
    })
  });
  $('.swalDefaultError').click(function() {
    Toast.fire({
      icon: 'error',
      title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
    })
  });
  $('.swalDefaultWarning').click(function() {
    Toast.fire({
      icon: 'warning',
      title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
    })
  });
  $('.swalDefaultQuestion').click(function() {
    Toast.fire({
      icon: 'question',
      title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
    })
  });
//tooltips
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
$(document).ready(function(){
    $("table").tooltip({
        selector: '[rel="tooltip"]'
    });

 
});


</script>
@stop

</html>


