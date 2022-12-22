<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str; //Extencion para importar imagen
use Yajra\DataTables\Facades\DataTables;

class EmpleadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        return view('empleados/index');
    }

    public function DatosServerSideActivo(Request $request){
        if ($request->ajax()) {
           
             //$roles=Empleado::all()->where('activo',1); no ocuparlo
             $empleado=Empleado::select('empleados.*')
             ->where('empleados.activo','=',1);
             return DataTables::of($empleado)
                // anadir nueva columna botones
                 ->addColumn('actions', function($empleado){
                    // $url= route('rol.permisos',$empleado->id);
                    // $url2= route('rol.destroy', $roles->id);
                     $btn= '<div class="btn-group btn-group-sm">'
                     .'<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Editar" onclick="Modificar('.$empleado->id.')" ><i class="far fa-edit"></i></a>'
                     .'<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Eliminar" onclick="Eliminar('.$empleado->id.')"><i class="far fa-trash-alt"></i></a>
                     </div>';
                   return  $btn;
                 })
                 ->addColumn('nombre_apellidos', function($empleado){
                    // $url= route('rol.permisos',$empleado->id);
                    // $url2= route('rol.destroy', $roles->id);
                     $x= $empleado->nombre.' '.$empleado->apellidos;
                   return  $x;
                 })
                 ->addColumn('foto', function($empleado){
                    $imagen='imagenes/empleados/'.$empleado->id.'.jpg'; 
                    if (!file_exists($imagen)) { // existe la imagen con el nombre del id empleado
                     $imagen = "imagenes/empleados/150x150.png";
                    }
                   $url=asset($imagen.'?'.time());
                   $r="'";
                   return  ' <a class="btn btn-sm" rel="tooltip" data-placement="top" title="Ver imagen" onclick="Imagen('.$r.$url.$r.')">  <div class="text-center" > <img width="50" height="30" src="'.$url.'"/> </div> </a>';
                
                //  return  '<div class="text-center" > <img width="50" height="30" src="'.$url.'"/> </div>';
                 })
                // 
                 ->rawColumns(['actions','nombre_apellidos','foto']) // incorporar columnas
                 ->make(true); // convertir a codigo
        }
    }
    public function DatosServerSideInactivo(Request $request){
        if ($request->ajax()) {
           
             //$roles=Empleado::all()->where('activo',1); no ocuparlo
             $empleado=Empleado::select('empleados.*')
             ->where('empleados.activo','=',0);
             return DataTables::of($empleado)
                // anadir nueva columna botones
                 ->addColumn('actions', function($empleado){
                    // $url= route('rol.permisos',$empleado->id);
                    // $url2= route('rol.destroy', $roles->id);
                     $btn= '<div class="text-right" > <div class="btn-group btn-group-sm">'
                     .'<a class="btn btn-secondary" rel="tooltip" data-placement="top" title="Restaurar" onclick="Restaurar('.$empleado->id.')"><i class="fas fa-arrow-alt-circle-up"></i></a>
                     </div> </div>';
                   return  $btn;
                 })
                 ->addColumn('foto', function($empleado){
                    $imagen='imagenes/empleados/'.$empleado->id.'.jpg'; 
                    if (!file_exists($imagen)) { // existe la imagen con el nombre del id empleado
                     $imagen = "imagenes/empleados/150x150.png";
                    }
                   $url=asset($imagen.'?'.time());
                   $r="'";
                   return  ' <a class="btn btn-sm" rel="tooltip" data-placement="top" title="Ver imagen" onclick="Imagen('.$r.$url.$r.')">  <div class="text-center" > <img width="50" height="30" src="'.$url.'"/> </div> </a>';
                
                 // return  ' <div class="text-center" > <img width="50" height="30" src="'.$url.'"/> </div>';
                 })
                 
                // 
                 ->rawColumns(['actions','foto']) // incorporar columnas
                 ->make(true); // convertir a codigo
        }
    }

    public function restore($id){
        $empleado=Empleado::all()->where('id','=',$id)->first();
        $empleado->activo=1;
        $empleado->update();
    }

    public function destroy($id){
        $empleado=Empleado::all()->where('id','=',$id)->first();
        $empleado->activo=0;
        $empleado->update();
    }

    public function buscarPorEmpleado($id){
        $empleado=Empleado::all()->where('id','=',$id)->first();
       /* $res['datos']=$empleado;
        $res['roles']=$roles;
        $res['usuarios']=$usuarios;*/
        return json_encode($empleado); 
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nombreM' => 'required|string|max:255',
            'sueldoM' => 'required|integer',
            'telefonoM' => 'required|integer',
            'nro_carnetM' => 'required|integer',
            'apellidosM' => 'required|string|max:255',
            'direccionM' => 'required|string|max:255',
            //'img_perfil' => 'image|mimes:jpg,jpeg'
        ]);

        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }

        $empleado=Empleado::all()->where('id','=',$id)->first();
        $empleado->nombre=$request->nombreM;
        $empleado->apellidos=$request->apellidosM;
        $empleado->direccion=$request->direccionM;
        $empleado->sueldo=$request->sueldoM;
        $empleado->nro_carnet=$request->nro_carnetM;
        $empleado->update();

        return $request;
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'sueldo' => 'required|integer',
            'telefono' => 'required|integer',
            'nro_carnet' => 'required|integer',
            'apellidos' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'img_perfil' => 'image|mimes:jpg,jpeg'
        ]);

        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }
        $empleado= new Empleado();
        $empleado->nombre=$request->nombre;
        $empleado->apellidos=$request->apellidos;
        $empleado->direccion=$request->direccion;
        $empleado->telefono=$request->telefono;
        $empleado->sueldo=$request->sueldo;
        $empleado->nro_carnet=$request->nro_carnet;
        $empleado->save();
        // colocar foto
        if ($request->hasFile("img_perfil")) {//existe un campo de tipo file?
            $imagen = $request->file("img_perfil"); //almacenar imagen en variable
            $nombreimagen=Str::slug($empleado->id).".".$imagen->guessExtension();//insertar parametro del nombre de imagen
            $ruta = public_path("imagenes/empleados/");//guardar en esa ruta
            $imagen->move($ruta,$nombreimagen); //mover la imagen es esa ruta y con ese nombre    
        }
        return $request;
    }
}
