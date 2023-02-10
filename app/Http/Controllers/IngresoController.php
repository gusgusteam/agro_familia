<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Models\ingreso_empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class IngresoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('ingresos/index');
    }

    public function DatosServerSideActivo(Request $request){
        if ($request->ajax()) {
            if(session('gestion_id') != -1){
             $ingreso=Ingreso::select(
                'ingresos.*',
                'users.name',
                'users.apellidos',
                'users.email',
                'cajas.nombre as caja_nombre'
                )
               // ->join('users','users.id')
             ->join('users','users.id','=','ingresos.id_usuario')
             ->join('cajas','cajas.id','=','ingresos.id_caja')
             ->orderBy('ingresos.created_at','desc')
             ->where('cajas.id_gestion','=',session('gestion_id'));
            }else{
                $ingreso=Ingreso::select(
                    'ingresos.*',
                    'users.name',
                    'users.apellidos',
                    'users.email',
                    'cajas.nombre as caja_nombre'
                    )
                   // ->join('users','users.id')
                 ->join('users','users.id','=','ingresos.id_usuario')
                 ->join('cajas','cajas.id','=','ingresos.id_caja')
                 ->orderBy('ingresos.created_at','desc')
                 ->where('users.id','=',Auth::user()->id);   
            }
             //->get();
             return DataTables::of($ingreso)
                // anadir nueva columna botones
                 ->addColumn('actions', function($ingreso){
                    $button2='<a class="btn  btn-success" rel="tooltip" data-placement="top" title="Detalles" onclick="Detalles('.$ingreso->id.')" ><i class="fab fa-wpforms"></i></a>';
                    if(Auth::user()->id != $ingreso->id_usuario){
                        if ($ingreso->visto==0){
                            $button='<a class="btn  btn-default" rel="tooltip" data-placement="top" title="Leer" onclick="Marcar('.$ingreso->id.')" ><i class="fas fa-eye"></i></a>';
                        }else{
                            $button='<a class="btn  btn-primary disabled" rel="tooltip" data-placement="top" title="Leer" onclick="Marcar('.$ingreso->id.')" ><i class="fas fa-eye"></i></a>';
                        }
                    }else{
                        $button='';
                    }
                    $btn= ' <div class="text-right" > <div class="btn-group btn-group-sm">'
                    .$button2
                    .$button.
                    '</div> </div>';
                   return  $btn;
                 })
                 ->addColumn('nombre_apellido', function($ingreso){
                  return  $ingreso->name.' '.$ingreso->apellidos;
                })
                 ->addColumn('foto', function($ingreso){
                    $imagen='imagenes/ingresos/'.$ingreso->id.'.jpg'; 
                    if (!file_exists($imagen)) { // existe la imagen con el nombre del id empleado
                     $imagen = "imagenes/ingresos/150x150.png";
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
            $empleado=ingreso_empleado::select(
                'empleados.*',
                'ingresos.id as id_ingreso',
            )  
            ->join('empleados','empleados.id','=','ingreso_empleados.id_empleado')
            ->join('ingresos','ingresos.id','=','ingreso_empleados.id_ingreso')
            ->where('ingresos.id','=',$id);
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
        $ingreso= Ingreso::all()->where('id','=',$id)->first();
        $ingreso->visto=1;
        $ingreso->update();
        return json_encode('leido ');
    }


}
