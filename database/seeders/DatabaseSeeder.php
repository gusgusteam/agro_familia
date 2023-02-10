<?php

namespace Database\Seeders;

use App\Models\Caja;
use App\Models\Egreso;
use App\Models\Empleado;
use App\Models\Gestion;
use App\Models\Ingreso;
use App\Models\Pempresa;
use App\Models\Ppersona;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Tipo;
use App\Models\Tipo_Producto;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;    // crear roles
use Spatie\Permission\Models\Permission; // crear permisos

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //creacion de roles y permisos 
       $role1=Role::create(['name'=>'Administrador','descripcion'=>'persona con el control total del sistema']);
       $role2=Role::create(['name'=>'Cliente','descripcion'=>'persona que consta con los servicios basicos']);
       $role3=Role::create(['name'=>'Repartidor','descripcion'=>'persona encargada de movimiento']);
       $role4=Role::create(['name'=>'Recepcionesta','descripcion'=>'persona con el control del sistema basicos']);
    
       //administracion usuarios
       Permission::create(['name'=> 'usuario', 'subname'=> 'usuario principal','tipo'=>2])->syncRoles([$role1,$role4]);
       Permission::create(['name'=> 'usuario.editar', 'subname'=> 'editar','tipo'=>2])->syncRoles([$role1]);
       Permission::create(['name'=> 'usuario.eliminar', 'subname'=> 'eliminar','tipo'=>2])->syncRoles([$role1]);
       Permission::create(['name'=> 'usuario.agregar', 'subname'=> 'agregar','tipo'=>2])->syncRoles([$role1]);
       Permission::create(['name'=> 'usuario.eliminados', 'subname'=> 'eliminados','tipo'=>2])->syncRoles([$role1,$role4]);
       Permission::create(['name'=> 'usuario.restore', 'subname'=> 'restaurar','tipo'=>2])->syncRoles([$role1]);
       //administracion roles
       Permission::create(['name'=> 'rol', 'subname'=> 'rol principal','tipo'=>3])->syncRoles([$role1,$role4]);
       Permission::create(['name'=> 'rol.editar', 'subname'=> 'editar','tipo'=>3])->syncRoles([$role1]);
       Permission::create(['name'=> 'rol.eliminar', 'subname'=> 'eliminar','tipo'=>3])->syncRoles([$role1]);
       Permission::create(['name'=> 'rol.agregar', 'subname'=> 'agregar','tipo'=>3])->syncRoles([$role1]);
       Permission::create(['name'=> 'rol.eliminados', 'subname'=> 'eliminados','tipo'=>3])->syncRoles([$role1,$role4]);
       Permission::create(['name'=> 'rol.restore', 'subname'=> 'restaurar','tipo'=>3])->syncRoles([$role4]);
       //administracion inventario
       Permission::create(['name'=> 'inventario', 'subname'=> 'inventario principal','tipo'=>4])->syncRoles([$role1]);
       Permission::create(['name'=> 'inventario.editar', 'subname'=> 'editar','tipo'=>4])->syncRoles([$role1]);
       Permission::create(['name'=> 'inventario.eliminar', 'subname'=> 'eliminar','tipo'=>4])->syncRoles([$role1]);
       Permission::create(['name'=> 'inventario.agregar', 'subname'=> 'agregar','tipo'=>4])->syncRoles([$role4]);
       Permission::create(['name'=> 'inventario.eliminados', 'subname'=> 'eliminados','tipo'=>4])->syncRoles([$role1,$role4]);
       Permission::create(['name'=> 'inventario.restore', 'subname'=> 'restaurar','tipo'=>4])->syncRoles([$role4]);
       //administracion reportes
       Permission::create(['name'=> 'reporte.general', 'subname'=> 'reporte general','tipo'=>5])->syncRoles([$role1,$role4]);
       Permission::create(['name'=> 'reporte.mensual', 'subname'=> 'reporte mensual','tipo'=>5])->syncRoles([$role1]);
       
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'apellidos'=>'carvajal',
            'edad'=>'21',
            'direccion'=>'montero',
            'telefono'=>'71619345',
            'password' => Hash::make('123'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'lucas',
            'email' => 'lucas@gmail.com',
            'apellidos'=>'carvajal barrios',
            'edad'=>'21',
            'direccion'=>'san jose',
            'telefono'=>'71619343',
            'password' => Hash::make('123'),
        ])->assignRole('Cliente');

        User::create([
            'name' => 'Elian',
            'email' => 'elian@gmail.com',
            'apellidos'=>'alvares choque',
            'edad'=>'21',
            'direccion'=>'santa cruz',
            'telefono'=>'71619343',
            'password' => Hash::make('123'),
        ])->assignRole('Repartidor');

        User::create([
            'name' => 'Paniagua',
            'email' => 'paniagua@gmail.com',
            'apellidos'=>'arana',
            'edad'=>'21',
            'direccion'=>'minero',
            'telefono'=>'71619343',
            'password' => Hash::make('123'),
        ])->assignRole('Recepcionesta');

        User::create([
            'name' => 'Enrique',
            'email' => 'enrique@gmail.com',
            'apellidos'=>'condori quispe',
            'edad'=>'21',
            'direccion'=>'montero',
            'telefono'=>'71619343',
            'password' => Hash::make('123'),
        ])->assignRole('Repartidor');

      /* Gestion::create([
            'nombre'=>'invierno 1-2021',
            'descripcion'=>'soya negrita, soya safiro, sorgo',
            'fecha_inicial'=>'2021-01-16',
            'id_usuario'=>1,
        ]);
        Gestion::create([
            'nombre'=>'verano 2-2021',
            'descripcion'=>'arroz + 18',
            'fecha_inicial'=>'2021-07-11',
            'id_usuario'=>1,
            'estado'=>1,
        ]);
        Gestion::create([
            'nombre'=>'invierno 1-2022',
            'descripcion'=>'soya negrita',
            'fecha_inicial'=>'2022-01-09',
            'id_usuario'=>1,
        ]);
        Gestion::create([
            'nombre'=>'verano 2-2021',
            'descripcion'=>'soya negrita , sorgo',
            'fecha_inicial'=>'2022-05-17',
            'id_usuario'=>1,
            'activo'=>0,
        ]);*/

        Tipo::create([
            'nombre'=>'ninguno',
            'option'=>1
        ]);
        Tipo::create([
            'nombre'=>'servicio tractor',
            'option'=>1
        ]);
        Tipo::create([
            'nombre'=>'trabajo normal',
            'option'=>1
        ]);
        Tipo::create([
            'nombre'=>'adelanto de trabajo',
            'option'=>1
        ]);
        Tipo::create([
            'nombre'=>'adelanto alquiler',
        ]);
        Tipo::create([
            'nombre'=>'adelanto',
        ]);
        Tipo::create([
            'nombre'=>'entidad financiera',
        ]);

        Empleado::create([
            'nombre'=>'lucas',
            'apellidos'=>'carvajal barrios',
            'telefono'=>71619345,
            'nro_carnet'=>8879285,
            'direccion'=>'montero-santa cruz',
            'sueldo'=>2000
        ]);
        Empleado::create([
            'nombre'=>'elian',
            'apellidos'=>'alvares choque',
            'telefono'=>828372,
            'nro_carnet'=>876255,
            'direccion'=>'montero',
            'sueldo'=>2110
        ]);

        Empleado::create([
            'nombre'=>'enrique',
            'apellidos'=>'condori',
            'telefono'=>71619345,
            'nro_carnet'=>8879285,
            'direccion'=>'montero-santa cruz',
            'sueldo'=>5000
        ]);
        Empleado::create([
            'nombre'=>'paniagua',
            'apellidos'=>'anagua',
            'telefono'=>828372,
            'nro_carnet'=>876255,
            'direccion'=>'montero',
            'sueldo'=>3900
        ]);

        $Proveedor1=Proveedor::create([
            'direccion' => 'montero-san jose',
            'correo' => 'montero@gmail.com',
            'telefono' => 8272221,
            'tipo'=>2
        ]);
        Pempresa::create([
            'razon_social'=>'BIOSET',
            'id_proveedor'=>$Proveedor1->id
        ]);
        $Proveedor2=Proveedor::create([
            'direccion' => 'SANTA CRUZ-plaza principal',
            'correo' => 'santacruz@gmail.com',
            'telefono' => 9817262,
            'tipo'=>2
        ]);
        Pempresa::create([
            'razon_social'=>'triple AAA',
            'id_proveedor'=>$Proveedor2->id
        ]);
        $Proveedor3=Proveedor::create([
            'direccion' => 'WARNES-mERCADO',
            'correo' => 'warnes@gmail.com',
            'telefono' => 827261,
            'tipo'=>2
        ]);
        Pempresa::create([
            'razon_social'=>'Impro Full',
            'id_proveedor'=>$Proveedor3->id
        ]);
        $Proveedor4=Proveedor::create([
            'direccion' => 'San jose del norte',
            'correo' => 'lucasgustavocarvajalbarrios@gmail.com',
            'telefono' => 71619345,
            'tipo'=>1
        ]);
        Ppersona::create([
            'nombre'=>'lucas',
            'paterno'=>'carvajal',
            'materno'=>'barrios',
            'id_proveedor'=>$Proveedor4->id
        ]);
        $Proveedor5=Proveedor::create([
            'direccion' => 'San jose del norte',
            'correo' => 'eva@gmail.com',
            'telefono' => 9181722,
            'tipo'=>1
        ]);
        Ppersona::create([
            'nombre'=>'eva luz',
            'paterno'=>'salazar',
            'materno'=>'prado',
            'id_proveedor'=>$Proveedor5->id
        ]);

        Tipo_Producto::create([
            'nombre'=>'Herbisida'
        ]);
        Tipo_Producto::create([
            'nombre'=>'Fungisida'
        ]);
        Tipo_Producto::create([
            'nombre'=>'Insectisida'
        ]);
        Tipo_Producto::create([
            'nombre'=>'Fertilizante Flor'
        ]);
        Tipo_Producto::create([
            'nombre'=>'Fertilizante llenado'
        ]);
        Tipo_Producto::create([
            'nombre'=>'Fertilizante tallo'
        ]);
        Tipo_Producto::create([
            'nombre'=>'Hormona'
        ]);

        Producto::create([
            'nombre' => 'amina 720 24D',
            'descripcion' => 'matar hoja oja ancha',
            'origen' => 'Boliviano',
            'precio_compra'=>'3.67',
            'precio_venta' => '4.10',
            'stock' =>0,
            'stock_minimo'=>0,
            'id_tipo_producto'=>1,
            'id_proveedor'=>1
        ]);
        Producto::create([
            'nombre' => 'Arrow',
            'descripcion' => 'matar malesas',
            'origen' => 'Boliviano',
            'precio_compra'=>'10.27',
            'precio_venta' => '11.90',
            'stock' =>0,
            'stock_minimo'=>0,
            'id_tipo_producto'=>2,
            'id_proveedor'=>1
        ]);
        Producto::create([
            'nombre' => 'Golden',
            'descripcion' => 'contrala enfermedades',
            'origen' => 'Boliviano',
            'precio_compra'=>'39.10',
            'precio_venta' => '45.00',
            'stock' =>0,
            'stock_minimo'=>0,
            'id_tipo_producto'=>3,
            'id_proveedor'=>2
        ]);
        Producto::create([
            'nombre' => 'Cloranta',
            'descripcion' => 'contrala malesas',
            'origen' => 'Boliviano',
            'precio_compra'=>'30.90',
            'precio_venta' => '34.10',
            'stock' =>0,
            'stock_minimo'=>0,
            'id_tipo_producto'=>2,
            'id_proveedor'=>1
        ]);
        Producto::create([
            'nombre' => 'Tandem',
            'descripcion' => 'control de enfermedades extremas',
            'origen' => 'Brazilero',
            'precio_compra'=>'45.60',
            'precio_venta' => '50.43',
            'stock' =>0,
            'stock_minimo'=>0,
            'id_tipo_producto'=>2,
            'id_proveedor'=>4
        ]);




       // User::factory()->create();

    }
}
