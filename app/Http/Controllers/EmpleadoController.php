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
             $empleado=Empleado::select('empleados.*')
             ->get();
             //->where('empleados.activo','=',1);
             return DataTables::of($empleado)
                // anadir nueva columna botones
                 ->addColumn('actions', function($empleado){
                    if($empleado->activo==0){
                        $btn2='<a class="btn btn-secondary" rel="tooltip" data-placement="top" title="Restaurar" onclick="Restaurar('.$empleado->id.')"><i class="fas fa-arrow-alt-circle-up"></i></a>';
                    }
                    if($empleado->activo==1){
                        $btn2='<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Eliminar" onclick="Eliminar('.$empleado->id.')"><i class="far fa-trash-alt"></i></a>';
                    }
                     $btn= '<div class="btn-group btn-group-sm">'
                     .'<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Editar" onclick="Modificar('.$empleado->id.')" ><i class="far fa-edit"></i></a>'
                     .$btn2
                     .'</div>';
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
                 })
                 ->addColumn('estado', function($empleado){

                    if($empleado->activo==0){
                        $span= '<span class="badge bg-danger">: inactivo</span>';
                    }
                    if($empleado->activo==1){
                        $span= '<span class="badge bg-success">: activo</span>';
                    }

                  return  $span;
                 })
                // 
                 ->rawColumns(['actions','foto','estado']) // incorporar columnas
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
        $imagen='imagenes/empleados/'.$empleado->id.'.jpg'; 
        if (!file_exists($imagen)) { // existe la imagen con el nombre del id empleado
            $imagen = "imagenes/empleados/150x150.png";
        }
        $url_foto=asset($imagen.'?'.time());
        $data=['empleado'=>$empleado,'url_foto'=>$url_foto];
        return json_encode($data); 
    }

    public function update(Request $request, $id){
        $data['error']=0;
        $validator = Validator::make($request->all(), [
            'nombre_modal_empleado' => 'required|string|max:255',
            'sueldo_modal_empleado' => 'required|integer',
            'telefono_modal_empleado' => 'required|integer',
            'nro_carnet_modal_empleado' => 'required|integer',
            'apellidos_modal_empleado' => 'required|string|max:255',
            'direccion_modal_empleado' => 'required|string|max:255',
            //'img_foto_modal_empleado' => 'image|mimes:jpg,jpeg'
        ]);

        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }

        $empleado=Empleado::all()->where('id','=',$id)->first();
        $empleado->nombre=$request->nombre_modal_empleado;
        $empleado->apellidos=$request->apellidos_modal_empleado;
        $empleado->direccion=$request->direccion_modal_empleado;
        $empleado->telefono=$request->telefono_modal_empleado;
        $empleado->sueldo=$request->sueldo_modal_empleado;
        $empleado->nro_carnet=$request->nro_carnet_modal_empleado;
        $empleado->update();
        if ($request->hasFile("img_foto_modal_empleado")) {//existe un campo de tipo file?
            $imagen = $request->file("img_foto_modal_empleado"); //almacenar imagen en variable
            $nombreimagen=Str::slug($empleado->id).".".$imagen->guessExtension();//insertar parametro del nombre de imagen
            $ruta = public_path("imagenes/empleados/");//guardar en esa ruta
            $imagen->move($ruta,$nombreimagen); //mover la imagen es esa ruta y con ese nombre      
        }


        return $data;
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
