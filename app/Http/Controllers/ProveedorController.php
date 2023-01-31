<?php

namespace App\Http\Controllers;

use App\Models\Pempresa;
use App\Models\Ppersona;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; //Extencion para importar imagen

class ProveedorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('proveedores.index');
    }

    public function DatosServerSideActivo(Request $request){
        if ($request->ajax()) {
        
             $persona=Ppersona::select(
                'ppersonas.*',
                'proveedors.telefono',
                'proveedors.correo',
                'proveedors.direccion',
                'proveedors.activo'
             )
             ->join('proveedors','proveedors.id','=','ppersonas.id_proveedor')->get();
             return DataTables::of($persona)
                // anadir nueva columna botones
                 ->addColumn('actions', function($persona){
                    if($persona->activo==0){
                        $btn2='<a class="btn btn-secondary" rel="tooltip" data-placement="top" title="Restaurar" onclick="Restaurar('.$persona->id_proveedor.')"><i class="fas fa-arrow-alt-circle-up"></i></a>';
                    }
                    if($persona->activo==1){
                        $btn2='<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Eliminar" onclick="Eliminar('.$persona->id_proveedor.')"><i class="far fa-trash-alt"></i></a>';
                    }
                  
                     $btn= '<div class="btn-group btn-group-sm">'
                     .'<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Editar" onclick="Modificar('.$persona->id_proveedor.')" ><i class="far fa-edit"></i></a>'
                     .$btn2.
                     '</div>';
                   return  $btn;
                 })
                 ->addColumn('estado', function($persona){

                    if($persona->activo==0){
                        $span= '<span class="badge bg-danger">: inactivo</span>';
                    }
                    if($persona->activo==1){
                        $span= '<span class="badge bg-success">: activo</span>';
                    }
                  return  $span;
                 })
                 ->addColumn('foto', function($persona){
                    $imagen='imagenes/proveedores/'.$persona->id_proveedor.'.jpg'; 
                    if (!file_exists($imagen)) { // existe la imagen con el nombre del id empleado
                     $imagen = "imagenes/proveedores/150x150.png";
                    }
                   $url=asset($imagen.'?'.time());
                   $r="'";
                   return  ' <a class="btn btn-sm" rel="tooltip" data-placement="top" title="Ver imagen" onclick="Imagen('.$r.$url.$r.')">  <div class="text-center" > <img width="50" height="30" src="'.$url.'"/> </div> </a>';
                 })
                // 
                 ->rawColumns(['actions','estado','foto']) // incorporar columnas
                 ->make(true); // convertir a codigo
        }
    }
    public function DatosServerSideInactivo(Request $request){
        if ($request->ajax()) {
             $empresa=Pempresa::select(
                'pempresas.*',
                //'proveedors.*'
                'proveedors.telefono',
                'proveedors.correo',
                'proveedors.direccion',
                'proveedors.activo'
                )
                ->join('proveedors','proveedors.id','=','pempresas.id_proveedor')->get();
             //->get();
             //->get();
             //->orderBy('proveedors.created_at','desc');
            // ->where('proveedors.activo','=',1);

             return DataTables::of($empresa)
                // anadir nueva columna botones
                 ->addColumn('actions', function($empresa){
                    if($empresa->activo==0){
                        $btn2='<a class="btn btn-secondary" rel="tooltip" data-placement="top" title="Restaurar" onclick="Restaurar('.$empresa->id_proveedor.')"><i class="fas fa-arrow-alt-circle-up"></i></a>';
                    }
                    if($empresa->activo==1){
                        $btn2='<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Eliminar" onclick="Eliminar('.$empresa->id_proveedor.')"><i class="far fa-trash-alt"></i></a>';
                    }
                     $btn= '<div class="text-right" > <div class="btn-group btn-group-sm">'
                     .'<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Editar" onclick="Modificar('.$empresa->id_proveedor.')" ><i class="far fa-edit"></i></a>'
                     .$btn2
                     .'</div> </div>';
                   return  $btn;
                 })
                 ->addColumn('estado', function($empresa){

                    if($empresa->activo==0){
                        $span= '<span class="badge bg-danger">: inactivo</span>';
                    }
                    if($empresa->activo==1){
                        $span= '<span class="badge bg-success">: activo</span>';
                    }
                  return  $span;
                 })
                 ->addColumn('foto', function($empresa){
                    $imagen='imagenes/proveedores/'.$empresa->id_proveedor.'.jpg'; 
                    if (!file_exists($imagen)) { // existe la imagen con el nombre del id empleado
                     $imagen = "imagenes/proveedores/150x150.png";
                    }
                   $url=asset($imagen.'?'.time());
                   $r="'";
                   return  ' <a class="btn btn-sm" rel="tooltip" data-placement="top" title="Ver imagen" onclick="Imagen('.$r.$url.$r.')">  <div class="text-center" > <img width="50" height="30" src="'.$url.'"/> </div> </a>';
                 })
                 
                 
                // 
                 ->rawColumns(['actions','estado','foto']) // incorporar columnas
                 ->make(true); // convertir a codigo
        }
    }

    public function buscar($id)
    {
        $proveedor= Proveedor::all()->where('id','=',$id)->first();
        //$dato=$proveedor;
        if($proveedor->tipo==1){//persona
            $data=Ppersona::all()->where('id_proveedor','=',$id)->first();
        }
        if($proveedor->tipo==2){// empresa
            $data=Pempresa::all()->where('id_proveedor','=',$id)->first();
        }
        $imagen='imagenes/proveedores/'.$proveedor->id.'.jpg'; 
        if (!file_exists($imagen)) { // existe la imagen con el nombre del id empleado
            $imagen = "imagenes/proveedores/150x150.png";
        }
        $url_foto=asset($imagen.'?'.time());
        $datos=['proveedor_tipo'=>$data,'proveedor'=>$proveedor,'url_foto'=>$url_foto];
        return json_encode($datos);
    }


    public function store(Request $request)
    {
        $data=['error'=>0];
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'paterno' => 'required',
            'materno' => 'required',
            'telefono' => 'required|integer',
            'tipo_proveedor' => 'required|integer',
            'correo' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255'
           // 'img_foto' => 'required'
        ]);
        
        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }

        if($request->tipo_proveedor==1){
            $proveedor = new Proveedor();
            $proveedor->telefono=$request->telefono;
            $proveedor->direccion=$request->direccion;
            $proveedor->correo=$request->correo;
        
            $proveedor->save();
            $persona = new Ppersona();
            $persona->nombre= $request->nombre;
            $persona->paterno=$request->paterno;
            $persona->materno=$request->materno;
            $persona->id_proveedor= $proveedor->id;
            $persona->save();
            $proveedor->tipo=$request->tipo_proveedor;
            $proveedor->update();
        }
        if($request->tipo_proveedor==2){
            $proveedor = new Proveedor();
            $proveedor->telefono=$request->telefono;
            $proveedor->direccion=$request->direccion;
            $proveedor->correo=$request->correo;
        
            $proveedor->save();
            $empresa = new Pempresa();
            $empresa->razon_social= $request->razon_social;
            $empresa->id_proveedor= $proveedor->id;
            $empresa->save();
            $proveedor->tipo=$request->tipo_proveedor;
            $proveedor->update();
        }
        // guardar foto
        if ($request->hasFile("img_foto")) {//existe un campo de tipo file?
            $imagen = $request->file("img_foto"); //almacenar imagen en variable
            $nombreimagen=Str::slug($proveedor->id).".".$imagen->guessExtension();//insertar parametro del nombre de imagen
            $ruta = public_path("imagenes/proveedores/");//guardar en esa ruta
            $imagen->move($ruta,$nombreimagen); //mover la imagen es esa ruta y con ese nombre    
        }
        return $data;
    }

    public function show(Proveedor $proveedor)
    {
        //
    }

    public function edit(Proveedor $proveedor)
    {
        //
    }


    public function update(Request $request, Proveedor $proveedor)
    {
        $data=['error'=>'0'];
        if($proveedor->tipo==1){//persona
            $validator = Validator::make($request->all(), [
                'nombre_modal_persona' => 'required|string|max:255',
                'paterno_modal_persona' => 'required|string|max:100',
                'materno_modal_persona' => 'required|string|max:100',
                'telefono_modal_persona' => 'required|integer',
                'correo_modal_persona' => 'required|string|max:255',
                'direccion_modal_persona' => 'required|string|max:255'
            ]);
            
            if($validator->fails())
            {
                $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
                return $data;
            }
            $proveedor->telefono=$request->telefono_modal_persona;
            $proveedor->direccion=$request->direccion_modal_persona;
            $proveedor->correo=$request->correo_modal_persona;
            $proveedor->update();
            $persona=Ppersona::all()->where('id_proveedor','=',$proveedor->id)->first();
            $persona->nombre=$request->nombre_modal_persona;
            $persona->materno=$request->materno_modal_persona;
            $persona->paterno=$request->paterno_modal_persona;
            $persona->update();
            if ($request->hasFile("img_foto_modal_persona")) {//existe un campo de tipo file?
                $imagen = $request->file("img_foto_modal_persona"); //almacenar imagen en variable
                $nombreimagen=Str::slug($proveedor->id).".".$imagen->guessExtension();//insertar parametro del nombre de imagen
                $ruta = public_path("imagenes/proveedores/");//guardar en esa ruta
                $imagen->move($ruta,$nombreimagen); //mover la imagen es esa ruta y con ese nombre      
            }
        }
        if($proveedor->tipo==2){// empresa
            $validator = Validator::make($request->all(), [
                'telefono_modal_empresa' => 'required|integer',
                'correo_modal_empresa' => 'required|string|max:255',
                'direccion_modal_empresa' => 'required|string|max:255',
                'razon_social_modal_empresa' => 'required|string|max:255'
            ]);
            
            if($validator->fails())
            {
                $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
                return $data;
            }
            $proveedor->telefono=$request->telefono_modal_empresa;
            $proveedor->direccion=$request->direccion_modal_empresa;
            $proveedor->correo=$request->correo_modal_empresa;
            $proveedor->update();
            $empresa=Pempresa::all()->where('id_proveedor','=',$proveedor->id)->first();
            $empresa->razon_social=$request->razon_social_modal_empresa;
            $empresa->update();
            if ($request->hasFile("img_foto_modal_empresa")) {//existe un campo de tipo file?
                $imagen = $request->file("img_foto_modal_empresa"); //almacenar imagen en variable
                $nombreimagen=Str::slug($proveedor->id).".".$imagen->guessExtension();//insertar parametro del nombre de imagen
                $ruta = public_path("imagenes/proveedores/");//guardar en esa ruta
                $imagen->move($ruta,$nombreimagen); //mover la imagen es esa ruta y con ese nombre      
            }
        }
        
        return $data;
    }

    public function destroy(Proveedor $proveedor)
    {
      $proveedor->activo=0;
      $proveedor->update();
      return $proveedor;  
    }
    public function restore(Proveedor $proveedor)
    {
      $proveedor->activo=1;
      $proveedor->update();
      return $proveedor;  
    }
}
