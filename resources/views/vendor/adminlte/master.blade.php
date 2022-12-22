<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre')

    {{-- Base Stylesheets --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

        {{-- Configured Stylesheets --}}
        @include('adminlte::plugins', ['type' => 'css'])

        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

        @if(config('adminlte.google_fonts.allowed', true))
            {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">--}}
        @endif
    @else
        <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @endif

    {{-- Livewire Styles --}}
    @if(config('adminlte.livewire'))
        @if(app()->version() >= 7)
            @livewireStyles
        @else
            <livewire:styles />
        @endif
    @endif

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')

    {{-- Favicon --}}
    @if(config('adminlte.use_ico_only'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    @elseif(config('adminlte.use_full_favicon'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicons/android-icon-192x192.png') }}">
        <link rel="manifest" crossorigin="use-credentials" href="{{ asset('favicons/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    @endif

</head>

<body class="@yield('classes_body')" @yield('body_data')>

    {{-- Body Content --}}
    @yield('body')
    
        <!-- Modal Eliminados-->
    <div class="modal fade" id="ModalEliminar" data-backdrop="static">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <input type="hidden" id="id_delete" value="">
            <div class="modal-header">
                    <h4 class="modal-title">Eliminar Registro</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                    <p>¿Desea Eliminar este registro?</p>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                    <a  id="Delete" class="btn btn-danger btn-ok btn-sm">Confirmar</a>
            </div>
          </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal Eliminados -->
      
    <!-- Modal Restaurar-->
    <div class="modal fade" id="ModalRestaurar" data-backdrop="static">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <input type="hidden" id="id_restore" value="">
            <div class="modal-header">
                    <h4 class="modal-title">Restaurar Registro</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                    <p>¿Desea Restaurar este registro?</p>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                    <a  id="Restore" class="btn btn-danger btn-ok btn-sm">Confirmar</a>
            </div>
        </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal Eliminados -->

    


    {{-- Base Scripts --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

        {{-- Configured Scripts --}}
        @include('adminlte::plugins', ['type' => 'js'])

        <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @else
        <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @endif
    

    {{-- Livewire Script --}}
    @if(config('adminlte.livewire'))
        @if(app()->version() >= 7)
            @livewireScripts
        @else
            <livewire:scripts />
        @endif
    @endif

    <script>
        $(function(){
            $.fn.dataTable.ext.errMode = 'throw';
        });
        
       /*$(function() {
            const languages = {
               'es': '{{asset('vendor/adminlte/Spanish.json')}}'
            };
            $.extend(true, $.fn.dataTable.defaults, {
                language: {
                    url: languages['es']
                },
            })   
        });
        */ 
    </script>
    
    <script>
       /* $(function() {
            const languages = {
                //'es': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
               'es': '{{asset('vendor/adminlte/Spanish.json')}}'
            };
      
            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
                className: 'btn btn-sm'
            })
          
            $.extend(true, $.fn.dataTable.defaults, {
               // responsive: true,
                language: {
                    url: languages['es']
                },
               // pageLength: 10,
               // aLengthMenu: [ [10,25, 50, 100, 200], [10,25, 50, 100, 200] ],
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        className: 'btn-outline-light',
                        text: 'Copiar',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'btn-outline-primary',
                        text: 'CSV',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'btn-success',
                        text: 'Excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }, 
                    {
                        extend: 'pdf',
                        className: 'btn-danger',
                        text: 'PDF',
                        title: 'informe general',
                        exportOptions: {
                          columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn-dark',
                        text: 'Imprimir',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }, 
                    {
                        extend: 'colvis',
                        className: 'btn-dark',
                        text: 'Visibilidad Columnas',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
                
            });
        
        });
        */
      </script>
     
    {{-- Custom Scripts --}}
    @yield('adminlte_js')

    @if (\Session::has('success'))
        <script>
            toastr.options = {
               "closeButton": false,
               "debug": false,
               "onclick": null,
               "showDuration": "100000",
               "hideDuration": "1000",
               "timeOut": "2000",
               "extendedTimeOut": "1000",
               
           };
            toastr.success('Se guardo con exito.')
        </script>
    @endif
    @if ($errors->any())
        <script>
            toastr.options = {
               "closeButton": false,
               "debug": false,
               "onclick": null,
               "showDuration": "100000",
               "hideDuration": "1000",
               "timeOut": "2000",
               "extendedTimeOut": "1000",          
           };
            toastr.error('Error al guardar comprobar datos.')  
        </script>
    @endif

    @if (!$errors->any())
    <script>
        function limpiarFormulario() {
        document.getElementById("miform").reset();
        }
    </script>
    @endif

    

    
</body>

</html>


