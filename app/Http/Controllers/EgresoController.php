<?php

namespace App\Http\Controllers;

use App\Models\Egreso;
use App\Models\egreso_empleado;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class EgresoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('egresos/index');
    }

    public function DatosServerSideActivo(Request $request){
        if ($request->ajax()) {
           
             //$roles=Empleado::all()->where('activo',1); no ocuparlo
             if(session('gestion_id') != -1){
                $egreso=Egreso::select(
                    'egresos.*',
                    'users.name',
                    'users.apellidos',
                    'users.email',
                    'cajas.nombre as caja_nombre'
                    )
                   // ->join('users','users.id')
                 ->join('users','users.id','=','egresos.id_usuario')
                 ->join('cajas','cajas.id','=','egresos.id_caja')
                 ->orderBy('egresos.created_at','desc')
                 ->where('cajas.id_gestion','=',session('gestion_id')); 
             }else{
                $egreso=Egreso::select(
                    'egresos.*',
                    'users.name',
                    'users.apellidos',
                    'users.email',
                    'cajas.nombre as caja_nombre'
                    )
                   // ->join('users','users.id')
                 ->join('users','users.id','=','egresos.id_usuario')
                 ->join('cajas','cajas.id','=','egresos.id_caja')
                 ->orderBy('egresos.created_at','desc')
                 ->where('users.id','=',Auth::user()->id);
                // ->where('cajas.id_gestion','=',session('gestion_id'));
             }
            
             //->get();
             return DataTables::of($egreso)
                // anadir nueva columna botones
                 ->addColumn('actions', function($egreso){
                    $button2='<a class="btn  btn-success" rel="tooltip" data-placement="top" title="Detalles" onclick="Detalles('.$egreso->id.')" ><i class="fab fa-wpforms"></i></a>';
                if(Auth::user()->id != $egreso->id_usuario){
                    if ($egreso->visto==0){
                        $button='<a class="btn  btn-default" rel="tooltip" data-placement="top" title="Leer" onclick="Marcar('.$egreso->id.')" ><i class="fas fa-eye"></i></a>';
                    }else{
                        $button='<a class="btn  btn-primary" rel="tooltip" data-placement="top" title="Leer" onclick="Marcar('.$egreso->id.')" ><i class="fas fa-eye"></i></a>';
                    }
                }else{ $button='';}
                     $btn= ' <div class="text-right" > <div class="btn-group btn-group-sm">'
                     .$button2
                     .$button.
                     '</div> </div>';
                   return  $btn;
                 })
                 ->addColumn('nombre_apellido', function($egreso){
                  return  $egreso->name.' '.$egreso->apellidos;
                })
                 ->addColumn('foto', function($egreso){
                    $imagen='imagenes/egresos/'.$egreso->id.'.jpg'; 
                    if (!file_exists($imagen)) { // existe la imagen con el nombre del id empleado
                     $imagen = "imagenes/egresos/150x150.png";
                    }
                   $url=asset($imagen.'?'.time());
                   $r="'";
                   return  ' <a class="btn btn-sm" rel="tooltip" data-placement="top" title="Ver imagen" onclick="Imagen('.$r.$url.$r.')">  <div class="text-center" > <img width="50" height="30" src="'.$url.'"/> </div> </a>';
                })
                // 
                 ->rawColumns(['actions','nombre_apellido','foto']) // incorporar columnas
                 ->make(true); // convertir a codigo
        }
    }

    public function buscarPorEmpleado(Request $request,$id){
        if ($request->ajax()) {
            $empleado=egreso_empleado::select(
                'empleados.*',
                'egresos.id as id_egre',
            )  
            ->join('empleados','empleados.id','=','egreso_empleados.id_empleado')
            ->join('egresos','egresos.id','=','egreso_empleados.id_egreso')
            ->where('egresos.id','=',$id);
            //->get();
   
            return DataTables::of($empleado)
                // anadir nueva columna botones
                ->addColumn('foto', function($empleado){
                    $imagen='imagenes/empleados/'.$empleado->id.'.jpg'; 
                    if (!file_exists($imagen)) { // existe la imagen con el nombre del id empleado
                    $imagen = "imagenes/empleados/150x150.png";
                    }
                    $url=asset($imagen.'?'.time());
                    $r="'";
                
                    return  ' <a class="btn btn-sm" rel="tooltip" data-placement="top" title="Ver imagen" onclick="Imagen('.$r.$url.$r.')">  <div class="text-center" > <img width="50" height="30" src="'.$url.'"/> </div> </a>';
                })
                // 
                ->rawColumns(['foto']) // incorporar columnas
                ->make(true); // convertir a codigo
        }
 
    }

    public function marcar($id){
        $egreso= Egreso::all()->where('id','=',$id)->first();
        $egreso->visto=1;
        $egreso->update();
        return json_encode('leido ');
    }
    
}
