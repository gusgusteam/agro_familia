<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'AGRO'.' '.date("Y"),
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => true,  // para activar icono de url
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Agro </b> AISA ',
    'logo_img' => 'vendor/adminlte/dist/img/Logo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => true,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/Logo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 80,
            'height' => 80,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [  /// animacion al refrescar la pagina y cargar
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/Logo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 100,
            'height' => 100,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-light', // canviamos el backgroup
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => false,  // false
    

   /*
    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,
    */
    'layout_topnav' => null,
    'layout_boxed' => false, // para que no se desplace todo con el topnav
    'layout_fixed_sidebar' => true, // para que no desplace el sidebar
    'layout_fixed_navbar' => true, // para que no desplace el navbar
    'layout_fixed_footer' => true, // se habilita el footer de abajo
    'layout_dark_mode' => null,



    'classes_auth_card' => 'card-outline card-success',
    // clase perzonalizada
    'classes_index' => 'card-outline card-primary',
    'classes_index_header' => 'w-100 text-center font-weight-bold ',
    'classes_modal' => 'card-primary',
    'classes_modal_header' => 'w-100 text-center font-weight-bold text-white ',
    //
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-success',


    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
   // 'classes_content_wrapper' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    //'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav' => 'navbar-white navbar-light ',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',


   // 'sidebar_mini' => 'lg',
    'sidebar_mini' => 'lg',
    'sidebar_collapse' => true,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => true,
    'sidebar_collapse_remember_no_transition' => true,
   // 'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 1,


    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    //'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',


    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    //'profile_url' => 'usuario/prueba',
    'profile_url' => 'perfil', // url para el perfil 


    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',


    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => true,
        ],
        [
            'type'         => 'navbar-notification',
            'id'           => 'my-notification',      // An ID attribute (required).
            'icon'         => 'fas fa-bell',          // A font awesome icon (required).
            'icon_color'   => 'warning',              // The initial icon color (optional).
            'label'        => 0,                      // The initial label for the badge (optional).
            'label_color'  => 'danger',               // The initial badge color (optional).
            'url'          => 'notifications/show',   // The url to access all notifications/elements (required).
            'topnav_right' => false,                   // Or "topnav => true" to place on the left (required).
            'dropdown_mode'   => true,                // Enables the dropdown mode (optional).
            'dropdown_flabel' => 'All notifications', // The label for the dropdown footer link (optional).
            'update_cfg'   => [
                'url' => 'notifications/get',         // The url to periodically fetch new data (optional).
                'period' => 30,                       // The update period for get new data (in seconds, optional).
            ],
        ],
        [
            'type'         => 'navbar-notification',
            'id'           => 'my-notification',
            'icon'         => 'fas fa-bell',
            'url'          => 'notifications/show',
            'topnav_right' => false,
            'dropdown_mode'   => true,
            'dropdown_flabel' => 'All notifications',
            'update_cfg'   => [
                'url' => 'notifications/get',
                'period' => 30,
            ],
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],
        [
            'type'         => 'darkmode-widget',
            'topnav_right' => true, // Or "topnav => true" to place on the left.
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        
        ['header' => 'PANEL'],
        [
            'text'        => 'INVENTARIO',
           // 'url'         => '#',
            'icon'        => 'far fa-fw fa-file',
            'label'       => 4,
            'label_color' => 'success',
            'submenu' => [
                [
                    'text' => 'PRODUCTOS',
                    'route'  => 'producto.index',
                    'icon' => 'fas fa-dollar-sign',
                ],
                [
                    'text' => 'PROVEEDORES',
                    'route'  => 'proveedor.index',
                    'icon' => 'fas fa-dollar-sign',
                ],
            ],
        ],
        [
            'text'        => 'CUENTAS',
           // 'url'         => '#',
            'icon'        => 'far fa-fw fa-file',
            'label'       => 4,
            'label_color' => 'success',
            'submenu' => [
                [
                    'text' => 'EGRESOS',
                    'route'  => 'egreso.index',
                    'icon' => 'fas fa-dollar-sign',
                ],
                [
                    'text' => 'INGRESOS',
                    'route'  => 'ingreso.index',
                    'icon' => 'fas fa-dollar-sign',
                ],
            ],
        ],
        [
            'text' => 'CAJA',
            'route' => 'caja.index',
            'icon' => 'fas fa-fw fa-user',
        ],
        [
            'text' => 'GESTION',
            'route'  => 'gestion.index',
            'icon' => 'fas fa-fw fa-lock',
        ],
        [
            'text'    => 'ADMINISTRACION',
            'icon'    => 'fas fa-tasks',
            'submenu' => [
                [
                    'text' => 'Usuarios',
                    'route'  => 'usuario.index',
                    'icon' => 'fas fa-users',
                ],
                [
                    'text' => 'Empleados',
                    'route'     => 'empleado.index',
                    'icon' => 'fas fa-street-view',
                ],
                [
                    'text' => 'Roles',
                    'route'  => 'rol.index',
                    'icon' => 'fas fa-user-shield',
                ],
            ],
        ],
        ['header' => 'labels'],
        [
            'text' => 'Reportes',
            'route'  => 'reporte.index',
            'icon' => 'fas fa-users',
        ],
        
        
    ],

   

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],


    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables/css/dataTables.bootstrap4.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/responsive/css/responsive.bootstrap4.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/jquery.dataTables.min.js',
                ],
               
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/jquery-validation/jquery.validate.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/dataTables.bootstrap4.min.js',
                ],
               
                
               
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/responsive/js/dataTables.responsive.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/responsive/js/responsive.bootstrap4.min.js',
                ],
                 /* archivos pdf y excel
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/jszip/jszip.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/pdfmake.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/vfs_fonts.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.html5.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.print.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.colVis.min.js',
                ],
                 
                componentes 
                */               
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2/css/select2.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/select2/js/select2.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/select2/js/select2.full.min.js',
                ],
               
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/bootstrap4-duallistbox/bootstrap-duallistbox.min.css',
                ],
                
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js',
                ],
                
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2/sweetalert2.all.min.js',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'Toastr' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/toastr/toastr.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/toastr/toastr.min.js',
                ],
            ],
        ],
        'Switch-Button' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/bootstrap-toogle/bootstrap4-toggle.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bootstrap-toogle/bootstrap4-toggle.min.js',
                ],
            ],
        ],
    ],

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],


    'livewire' => false,
];
