@extends('adminlte::page2')

@section('title')

@section('content_header')
    <h1></h1>
@stop
<body class="hold-transition layout-top-nav layout-navbar-fixed">
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    
        <a href="{{ url('/') }}" class="navbar-brand">
          <img src="" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
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
</body>

<div class="container">
    <div class="container">
 
    </div>
    
    <h1 class="text-center">Productos</h1>
    <div class="row row-cols-1 row-cols-sm-2  row-cols-md-3 row-cols-lg-4  g-3">
      <div class="col">
        <div class="card shadow-lg card-danger card-outline">
            <img src="{{asset('vendor/adminlte/dist/img/Logo.png')}}" alt="imagen producto">
            <div class="card-body">
                <h5 class="card-title">titulo</h5>
                <p class="card-text  mb-0">precio Bs </p>
                <p class="card-text mb-2 text-right">Stock: 122</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="#"class="btn btn-sm btn-outline-info">Detalles</a>
                    </div>
              
                    <form action="#" method="POST">
                      @csrf
                      <input type="hidden" id="producto_id"name="producto_id" value="">
                      {{-- <button class="btn btn-sm btn-outline-warning" type="submit" name="btn" onclick="#" >Agregar al carrito</button> --}}
                      <button class="btn btn-sm btn-outline-danger" type="button" onclick="addproducto(1)" name="btn" onclick="#" >Agregar al carrito</button>
                      
                      {{-- <button class="btn btn-sm btn-outline-warning btn-submit" type="submit" >Agregar al carrito</button> --}}
                    </form>
                        
                </div>
            </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop



@section('js')

        
@stop