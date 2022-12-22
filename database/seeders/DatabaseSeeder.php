<?php

namespace Database\Seeders;

use App\Models\Caja;
use App\Models\Egreso;
use App\Models\Empleado;
use App\Models\Gestion;
use App\Models\Ingreso;
use App\Models\Tipo;
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
        ]);
        Tipo::create([
            'nombre'=>'rastreada',
        ]);
        Tipo::create([
            'nombre'=>'roleada',
        ]);
        Tipo::create([
            'nombre'=>'jumigada',
        ]);
        Tipo::create([
            'nombre'=>'trabajo tractorista',
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


        User::factory(1000)->create();

    }
}
