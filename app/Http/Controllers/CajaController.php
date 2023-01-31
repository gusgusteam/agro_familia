<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Egreso;
use App\Models\egreso_empleado;
use App\Models\Empleado;
use App\Models\Gestion;
use App\Models\Ingreso;
use App\Models\ingreso_empleado;
use App\Models\Socio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; //Extencion para importar imagen
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class CajaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('cajas/index');
    }

    public function DatosServerSideActivo(Request $request){
        if ($request->ajax()) {   
           // $caja=Caja::select('cajas.*')->whereIn('cajas.activo',[1,-1]);
            $caja=Socio::select(
                'cajas.nombre',
                'cajas.descripcion',
                'cajas.id',
                'cajas.tipo_caja',
                'cajas.monto_total',
                'cajas.activo',
                'cajas.id_gestion',
                'socios.cargo',
                'socios.id_caja',
                'socios.id_usuario'
            )
            ->join('cajas','cajas.id','=','socios.id_caja')
            ->join('users','users.id','=','socios.id_usuario')
            ->where('users.id','=',Auth::user()->id)
            ->where('users.estado','=',1)
            ->whereIn('cajas.activo',[1,-1]);
            //->get();
            return DataTables::of($caja)
                // anadir nueva columna botones
                 ->addColumn('actions', function($caja){
                    $button_grupo='';
                    $button_grupo2='';
                    $button_grupo3='';
                    $button_grupo4='';
                   
                    if($caja->tipo_caja==1 || $caja->tipo_caja==-1 ){
                        $url1= route('socio', $caja->id);
                        if($caja->activo==-1){
                            $button_grupo='<a class="btn btn-default" rel="tooltip" data-placement="top" title="grupo de socios" href="'.$url1.'" ><i class="far fa-user"></i></a>';
                        }else{
                            $button_grupo='<a class="btn btn-default intermitente" rel="tooltip" data-placement="top" title="grupo de socios" href="'.$url1.'" ><i class="far fa-user"></i></a>';
                        }
                    }
                    if($caja->cargo==1 & $caja->tipo_caja==1){
                        $url_propio=route('gestion.gasto',[$caja->id,'1']);
                        $button_grupo2='<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Editar" onclick="Modificar('.$caja->id.')" ><i class="far fa-edit"></i></a>';
                        $button_grupo3='<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Eliminar" onclick="Eliminar('.$caja->id.')"><i class="far fa-trash-alt"></i></a>';
                        $button_grupo4='<a class="btn btn-success" rel="tooltip" data-placement="top" title="Ingresos y egresos" href="'.$url_propio.'" ><i class="fas fa-balance-scale-right"></i></a>';
                    }
                    if($caja->tipo_caja==0 & $caja->cargo==0 ){
                        $button_grupo2='<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Editar" onclick="Modificar('.$caja->id.')" ><i class="far fa-edit"></i></a>';
                        $button_grupo3='<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Eliminar" onclick="Eliminar('.$caja->id.')"><i class="far fa-trash-alt"></i></a>';  
                    }
                    if($caja->tipo_caja==0 & $caja->cargo==1 ){
                        $url_propio=route('gestion.gasto',[$caja->id,'1']);
                        $button_grupo4='<a class="btn btn-success" rel="tooltip" data-placement="top" title="Ingresos y egresos" href="'.$url_propio.'" ><i class="fas fa-balance-scale-right"></i></a>';
                        $button_grupo2='<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Editar" onclick="Modificar('.$caja->id.')" ><i class="far fa-edit"></i></a>';
                        $button_grupo3='<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Eliminar" onclick="Eliminar('.$caja->id.')"><i class="far fa-trash-alt"></i></a>';  
                    }
                    if($caja->tipo_caja==-1 & $caja->cargo==1 ){
                        $button_grupo2='<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Editar" onclick="Modificar('.$caja->id.')" ><i class="far fa-edit"></i></a>';
                        $button_grupo3='<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Eliminar" onclick="Eliminar('.$caja->id.')"><i class="far fa-trash-alt"></i></a>';  
                    }
                    if($caja->tipo_caja==-1  & $caja->cargo==0 ){
                        $url2=route('gestion.gasto',[$caja->id_gestion,'0']);
                        $button_grupo4='<a class="btn btn-success" rel="tooltip" data-placement="top" title="Ingresos y egresos" href="'.$url2.'" ><i class="fas fa-balance-scale-right"></i></a>';
                    }
                    if($caja->tipo_caja==1  & $caja->cargo==0 ){
                        $url_propio=route('gestion.gasto',[$caja->id,'1']);
                        $button_grupo4='<a class="btn btn-success" rel="tooltip" data-placement="top" title="Ingresos y egresos" href="'.$url_propio.'" ><i class="fas fa-balance-scale-right"></i></a>';
                    }
                   
                     $btn= '<div class="text-right">  <div class="btn-group btn-group-sm ">'
                     .$button_grupo
                     .$button_grupo4
                     .$button_grupo2
                     .$button_grupo3
                     
                     .'</div>  </div> ';
                   return  $btn;
                 })
                 ->addColumn('tipo', function($caja){
                    $span='';
                    if($caja->tipo_caja==0){
                        $span= '<span class="badge bg-success">caja personal</span>';
                    }
                    if($caja->tipo_caja==1){
                        $span= '<span class="badge bg-danger">caja grupal</span>';
                    }
                    if($caja->tipo_caja==-1){
                        $span= '<span class="badge bg-warning">caja de gestion</span>';
                    }
                  return  $span;
                })
                 
                // 
                 ->rawColumns(['actions','tipo']) // incorporar columnas
                 ->make(true); // convertir a codigo
         }
    }

    public function DatosServerSideInactivo(Request $request){
        if ($request->ajax()) {
           
           // $caja=Caja::select('cajas.*')->where('cajas.activo','=',0);
           $caja=Socio::select(
            'cajas.nombre',
            'cajas.descripcion',
            'cajas.id',
            'cajas.tipo_caja',
            'cajas.monto_total',
            'cajas.activo',
            'socios.cargo',
            'socios.id_caja',
            'socios.id_usuario'
            )
            ->join('cajas','cajas.id','=','socios.id_caja')
            ->join('users','users.id','=','socios.id_usuario')
            ->where('users.id','=',Auth::user()->id)
            ->where('users.estado','=',1)
            ->where('socios.cargo','=',1)
            ->whereIn('cajas.activo',[0]);
            //->get();
             return DataTables::of($caja)
                // anadir nueva columna botones
                 ->addColumn('actions', function($caja){  
                     $btn= '<div class="text-right"> <div class="btn-group btn-group-sm">'
                     .'<a class="btn btn-secondary" rel="tooltip" data-placement="top" title="Restaurar" onclick="Restaurar('.$caja->id.')"><i class="fas fa-arrow-alt-circle-up"></i></a>
                     </div> </div> ';
                   return  $btn;
                 })
                //
                ->addColumn('tipo', function($caja){
                    $span='';
                    if($caja->tipo_caja==0){
                        $span= '<span class="badge bg-success">caja personal</span>';
                    }
                    if($caja->tipo_caja==1){
                        $span= '<span class="badge bg-danger">caja grupal</span>';
                    }
                    if($caja->tipo_caja==-1){
                        $span= '<span class="badge bg-warning">caja de gestion</span>';
                    }
                  return  $span;
                })
                 ->rawColumns(['actions','tipo']) // incorporar columnas
                 ->make(true); // convertir a codigo
        }
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:200',
            'tipo_caja' => 'required|integer',
        ]);

        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }
        $r=  new Caja();
        $r->nombre=$request->nombre;
        $r->descripcion=$request->descripcion;
        $r->monto_total=0;
        $r->tipo_caja=$request->tipo_caja;
        $r->save();
         //creamos el nuevo socio el que creo la caja es el admin de la caja
        $socio= new Socio();
        $socio->id_caja=$r->id;
        $socio->id_usuario=Auth::user()->id;
        $socio->cargo=1;
        $socio->save();
        return $request; 
    }

    public function update(Request $request,$id)
    {
        $caja=Caja::findOrFail($id);
        $caja->nombre=$request->nombreM;
        $caja->descripcion=$request->descripcionM;
        $caja->update();
        return $request;
    }

    public function destroy($id)
    {
        $caja = Caja::findOrFail($id);
        $caja->activo = 0;
        $caja->update();
    }

    public function restore($id)
    {// tomar en cuenta el metodo
        
        $caja = Caja::findOrFail($id);
        $comprobar=$caja->id_gestion;
        $verificar1=1;
        $verificar2=0; 
        if($comprobar != null){
        $gestion= Gestion::findOrFail($comprobar);
        $verificar1=$gestion->activo;
        $verificar2=$gestion->estado;
        }
        if($verificar1==1 && $verificar2==0){
            $caja->activo = 1;
            $caja->update();
            $res['error']=0;
        }else{
        
            if($verificar1!=1){
                $res['mensaje']="la gestion esta eliminada";          
            }else{
                if($verificar2!=0){
                    $res['mensaje']="la gestion finalizo";  
                }
            }
            $res['error']=1;
        }
        return $res;
    }

    public function buscarPorCaja($id){
        $caja=Caja::findOrFail($id);
        $res['datos']=$caja;
        echo json_encode($res);
    }

    // buscador de socios con el nombre
    public function buscarPorUsuario($valor){   // tambien por empleado
     //  $usuarios = User::where('name', 'LIKE', '%'.$valor.'%')->where('estado','=',1)->get();
       if($valor==0){
        $empleado = Empleado::where('activo','=',1)->get();
        $res['empleado']=$empleado;
       }else{
        $usuarios = User::where('estado','=',1)->get();
       // $usuarios=User::select('users.*')->where('users.estado','=',1);
       //$usuarios = User::all();
        $res['user']=$usuarios;
       }
      return  json_encode($res);
      //return $res;
    }


    public function socio($id){
        //actualizar el activo a -1 para que muestre la animacion de los socios
        $caja=Caja::all()->where('id','=',$id)->first();
        $caja->activo=-1;
        $caja->update();
        $id_caja=$id;
        $nombre_caja=$caja->nombre;
        return view('cajas/socios',compact('id_caja','nombre_caja'));
 
    }

    public function socio_DatosServerSideActivo(Request $request,$id){
        if ($request->ajax()) {   // id_caja 
            $socio=Socio::select(
                'users.name',
                'users.apellidos',
                'users.email',
                'users.edad',
                'socios.cargo',
                'socios.id_caja',
                'socios.id_usuario'
            )
            ->join('cajas','cajas.id','=','socios.id_caja')
            ->join('users','users.id','=','socios.id_usuario')
            ->where('cajas.id','=',$id)
            ->where('users.estado','=',1)
            ->get();

            $aux_socio=$socio;
            //verificacion si el user autentificado es el encardado de la caja 
            $aux_socio =$aux_socio->where('id_usuario','=',Auth::user()->id)->where('cargo','=',1)->first();
            if($aux_socio){
                return DataTables::of($socio)
                // anadir nueva columna botones
                 ->addColumn('actions', function($socio){
                     $btn= '<div class="text-right">  <div class="btn-group btn-group-sm ">'
                     .'<a class="btn btn-danger" rel="tooltip" data-placement="top" title="Eliminar" onclick="Eliminar('.$socio->id_caja.','.$socio->id_usuario.')"><i class="far fa-trash-alt"></i></a>
                     </div>  </div> ';
                    
                   return  $btn;
                 })
                 ->addColumn('cargo_tipo', function($socio){
                    $span='';
                    if($socio->cargo==1){
                        $span= '<span class="badge bg-success">Encargado</span>';
                    }
                    if($socio->cargo==0){
                        $span= '<span class="badge bg-danger">Subordinado</span>';
                    }
                  return  $span;
                })
                 ->rawColumns(['actions','cargo_tipo']) // incorporar columnas
                 ->make(true); // convertir a codigo
            }else{ // no se hara botones porq no es el encargado
                return DataTables::of($socio)
                // anadir nueva columna botones
                 ->addColumn('actions', function($socio){
                    $btn='';
                   return  $btn;
                 })
                 ->addColumn('cargo_tipo', function($socio){
                    $span='';
                    if($socio->cargo==1){
                        $span= '<span class="badge bg-success">Encargado</span>';
                    }
                    if($socio->cargo==0){
                        $span= '<span class="badge bg-danger">Subordinado</span>';
                    }
                  return  $span;
                })
                 
                 ->rawColumns(['actions','cargo_tipo']) // incorporar columnas
                 ->make(true); // convertir a codigo
            }
        }
    }



    public function socio_add(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'usuarios_id' => 'required',
            'id_caja' => 'required',
        ]);

        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }
        $verificar=Socio::all()->where('id_caja','=',$request->id_caja)->where('id_usuario','=',Auth::user()->id)->first();
        // verifciar si el usuario autentificado es el encargado de la caja
        if($verificar->cargo==0){
            $data=['error'=>'1','mensaje'=>'usted es un subordindo no puede agregar socios'];  // all() 
            return $data;
        }

        $usuarios_marcados=collect($request->usuarios_id);
        $n=count($usuarios_marcados);
        if($n != 0){
            $i=0;
            while ($i<$n) {
                $socio_ver = Socio::all()->where('id_caja','=',$request->id_caja)->where('id_usuario','=',$usuarios_marcados[$i])->first();
                if(!$socio_ver){// verificar si existe el socio en la caja
                    $socio= new Socio();
                    $socio->id_caja=$request->id_caja;
                    $socio->id_usuario=$usuarios_marcados[$i];
                    $socio->save();
                }
            $i=$i+1;
            }
        }else{
            $data=['error'=>'1','mensaje'=>'no marco ningun socio'];  // all() 
            return $data;
        }
        //creamos el nuevo socio
        return $request;
       // return $request;
    }

    public function socio_destroy(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'id_usuarioM' => 'required',
            'id_cajaM' => 'required',
        ]);
        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }
        //eliminamos el registro y vericar que el encargado no se elimine a asi mismo
        $verificar=$request->id_usuarioM;

        if($verificar!=Auth::user()->id){
        $socio = Socio::all()->where('id_caja','=',$request->id_cajaM)->where('id_usuario','=',$request->id_usuarioM)->first();
        $socio->delete();
        return $request;
        }else{
            $data=['error'=>'1','mensaje'=>'usted es un encargado no puede eliminarse asi mismo'];  // all() 
            return $data; 
        }
    }

    public function egreso_add(Request $request)
    {// id de la caja para relacionar
        
        $validator = Validator::make($request->all(), [
            'descripcionM' => 'required',
            'montoM' => 'required|numeric|min:0',
            'id_tipo'=>'required',
            'id_caja_egreso'=>'required',
            'img_perfil' => 'image|mimes:jpg,jpeg'
        ]);
        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }

        $caja=Caja::findOrFail($request->id_caja_egreso);
        $monto_aux=$caja->monto_total-$request->montoM;
        if($monto_aux>=0){
            if($caja->id_gestion != null){  // comprobar si es caja de gestion o personal
                $gestion=Gestion::all()->where('id','=',$caja->id_gestion)->first();
                $verificar=$gestion->estado;
            }else{$verificar=0;}
            //$gestion=Gestion::all()->where('id','=',$caja->id)->first();
            if ($verificar != 1 ) { // verificar q la gestion no este finalizada
                $egreso=new Egreso();
                $egreso->descripcion=$request->descripcionM;
                $egreso->monto=$request->montoM;
                $egreso->id_tipo=$request->id_tipo;
                $egreso->id_caja=$request->id_caja_egreso;
                $egreso->id_usuario=Auth::user()->id;
                $egreso->save();
                $caja->monto_total-=$egreso->monto;
                $caja->update();
                // foto
                if ($request->hasFile("img_perfil")) {//existe un campo de tipo file?
                    $imagen = $request->file("img_perfil"); //almacenar imagen en variable
                    $nombreimagen=Str::slug($egreso->id).".".$imagen->guessExtension();//insertar parametro del nombre de imagen
                    $ruta = public_path("imagenes/egresos/");//guardar en esa ruta
                    $imagen->move($ruta,$nombreimagen); //mover la imagen es esa ruta y con ese nombre    
                }
                // empleados
                $empleados_marcados=collect($request->id_empleados);
                
                $n=count($empleados_marcados);
                if($n != 0){
                    $i=0;
                    while ($i<$n) {
                        $egreso_empleado=new egreso_empleado();
                        $egreso_empleado->id_egreso=$egreso->id;
                       // $array=$request->input('id_empleados');
                        $egreso_empleado->id_empleado=$empleados_marcados[$i];
                       // $egreso_empleado->monto=$empleados_marcados[$i]['sueldo'];
                        $egreso_empleado->save();
                        $i=$i+1;
                    }
                }
            }else{
                $data=['error'=>'1','mensaje'=>'la gestion ya ha finalizado'];  // all() 
                return $data; 
            }
        }else{
            $data=['error'=>'1','mensaje'=>'monto no permitido por el monto total de caja'];  // all() 
            return $data;  
        }
        return $request;
    }

    
    public function ingreso_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descripcion2M' => 'required',
            'montoM' => 'required|numeric|min:0',
            'id_tipo2'=>'required',
            'id_caja_ingreso'=>'required',
            'img_perfil2' => 'image|mimes:jpg,jpeg'
        ]);
        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }
        
        $caja=Caja::findOrFail($request->id_caja_ingreso);
        if($caja->id_gestion != null){  // comprobar si es caja de gestion o personal
            $gestion=Gestion::all()->where('id','=',$caja->id_gestion)->first();
            $verificar=$gestion->estado;
        }else{$verificar=0;}
        if ($verificar != 1) { // verificar q la gestion no este finalizada
            $ingreso=new Ingreso();
            $ingreso->descripcion=$request->descripcion2M;
            $ingreso->monto=$request->montoM;
            $ingreso->id_tipo=$request->id_tipo2;
            $ingreso->id_caja=$request->id_caja_ingreso;
            $ingreso->id_usuario=Auth::user()->id;
            $ingreso->save(); 
            $caja->monto_total+=$ingreso->monto;
            $caja->update();
            // foto
            if ($request->hasFile("img_perfil2")) {//existe un campo de tipo file?
                $imagen = $request->file("img_perfil2"); //almacenar imagen en variable
                $nombreimagen=Str::slug($ingreso->id).".".$imagen->guessExtension();//insertar parametro del nombre de imagen
                $ruta = public_path("imagenes/ingresos/");//guardar en esa ruta
                $imagen->move($ruta,$nombreimagen); //mover la imagen es esa ruta y con ese nombre    
            }
            // empleados
            $empleados_marcados=collect($request->id_personas);
            $n=count($empleados_marcados);
            if($n != 0){
                $i=0;
                while ($i<$n) {
                    $ingreso_empleado=new ingreso_empleado();
                    $ingreso_empleado->id_ingreso=$ingreso->id;
                    $ingreso_empleado->id_empleado=$empleados_marcados[$i];
                    $ingreso_empleado->save();
                    $i=$i+1;
                }
            }
        }else{
            $data=['error'=>'1','mensaje'=>'la gestion ya ha finalizado'];  // all() 
            return $data;   
        }
        return $request;
    }

    public function  caja_monto($id){
        $caja=Caja::findOrFail($id);
        $suma_ingreso=Ingreso::select(
            'ingresos.monto'
        )
        ->where('ingresos.id_caja','=',$id)
        ->sum('ingresos.monto');
        $suma_egreso=Egreso::select(
            'egresos.monto'
        )
        ->where('egresos.id_caja','=',$id)
        ->sum('egresos.monto');
        $res['monto']=$caja->monto_total;
        $res['monto_ingreso']=$suma_ingreso;
        $res['monto_egreso']=$suma_egreso;
        echo json_encode($res);
    }

    public function Data_Ingresos(Request $request , $id){ // id de la caja
        if ($request->ajax()) {
           
            $ingreso=Ingreso::select(
                'ingresos.id' ,
                'ingresos.id_caja',
                'ingresos.id_tipo',
                'ingresos.descripcion',
                'ingresos.monto'
            )
            ->where('ingresos.id_caja','=',$id)
            ->orderBy('ingresos.created_at','desc');
            
             return DataTables::of($ingreso)
                // anadir nueva columna botones
                 ->addColumn('actions', function($ingreso){ 
                    $btn='';
                    $socio = Socio::all()->where('id_caja','=',$ingreso->id_caja)->where('id_usuario','=',Auth::user()->id)->first();
                    if($socio->cargo==1){
                        $btn= '<div class="text-right"> <div class="btn-group btn-group-sm">'
                     .'<a class="btn btn-light" rel="tooltip" data-placement="top" title="Eliminar" onclick="Eliminar_ingreso('.$ingreso->id.')"><i class="fas fa-trash-alt"></i></a>
                     </div> </div> ';
                    }  
                   return  $btn;
                 })
                //
                 ->rawColumns(['actions']) // incorporar columnas
                 ->make(true); // convertir a codigo
        }
    }

    public function Data_Egresos(Request $request , $id){ // id de la caja
        if ($request->ajax()) {
            $egreso=Egreso::select(
                'egresos.id' ,
                'egresos.id_caja',
                'egresos.id_tipo',
                'egresos.descripcion',
                'egresos.monto'
            )
            ->where('egresos.id_caja','=',$id)
            ->orderBy('egresos.created_at','desc');
             return DataTables::of($egreso)
                // anadir nueva columna botones
                 ->addColumn('actions', function($egreso){ 
                    $btn='';
                    $socio = Socio::all()->where('id_caja','=',$egreso->id_caja)->where('id_usuario','=',Auth::user()->id)->first();
                    if($socio->cargo==1){ 
                     $btn= '<div class="text-right"> <div class="btn-group btn-group-sm">'
                     .'<a class="btn  btn-light" rel="tooltip" data-placement="top" title="Eliminar" onclick="Eliminar_egreso('.$egreso->id.')"><i class="fas fa-trash-alt"></i></a>
                     </div> </div> ';
                    }
                   return  $btn;
                 })
                //
                 ->rawColumns(['actions']) // incorporar columnas
                 ->make(true); // convertir a codigo
        }
    }

    public function ingreso_destroy($id){    
        $res['error']=0;
        $ingreso=Ingreso::findOrFail($id);
        $caja=Caja::findOrFail($ingreso->id_caja);
        $monto_aux=$caja->monto_total-$ingreso->monto;
        if($monto_aux>=0){
            
            if($caja->id_gestion != null){  // comprobar si es caja de gestion o personal
                $gestion=Gestion::all()->where('id','=',$caja->id_gestion)->first();
                $verificar=$gestion->estado;
            }else{$verificar=0;}
            if ($verificar != 1) { // verificar q la gestion no este finalizada
                $caja->monto_total=$caja->monto_total-$ingreso->monto;
                $caja->update();
                $id_ingreso=$ingreso->id; // capturar el id del ingreso antes de eliminarlo
                $ingreso->delete();
                //script para eliminar  una imagen
                $image_path = public_path("imagenes/ingresos/{$id_ingreso}.jpg");
                if (File::exists($image_path)) {
                    File::delete($image_path);  //eliminar imagen existente
                }
            }else{
                $data=['error'=>'1','mensaje'=>'la gestion ya ha finalizado'];  // all() 
                return $data;   
            }
        }else{
            $res['error']=1; 
            $res['mensaje']='no puede eliminar el ingreso por motivos de caja'; 
        }
        
        echo json_encode($res);
    }

    public function egreso_destroy($id){
        $res['error']=0;
        $egreso=Egreso::findOrFail($id);
        $id_egreso=$egreso->id; // capturar el id del ingreso antes de eliminarlo
        $caja=Caja::findOrFail($egreso->id_caja);
        if($caja->id_gestion != null){  // comprobar si es caja de gestion o personal
            $gestion=Gestion::all()->where('id','=',$caja->id_gestion)->first();
            $verificar=$gestion->estado;
        }else{$verificar=0;}

        if ($verificar != 1) { // verificar q la gestion no este finalizada
            egreso_empleado::where('id_egreso',$id)->delete();
            $caja->monto_total=$caja->monto_total+$egreso->monto;
            $caja->update();
            $egreso->delete();
            //script para eliminar  una imagen
            $image_path = public_path("imagenes/egresos/{$id_egreso}.jpg");
            if (File::exists($image_path)) {
                File::delete($image_path);  //eliminar imagen existente
            }
        }else{
            $data=['error'=>'1','mensaje'=>'la gestion ya ha finalizado'];  // all() 
            return $data;   
        }
        echo json_encode($res);
    }

}
