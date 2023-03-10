<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; //Extencion para importar imagen
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
//use Yajra\DataTables\DataTables;

class UsuarioController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('usuarios.index');
    }

    public function DatosServerSideActivo(Request $request){
        if ($request->ajax()) {
             $user=User::select('users.*')->with('roles')
             ->where('users.estado','=',1);
             return DataTables::of($user)
                // anadir nueva columna botones
                 ->addColumn('actions', function($user){
                    if($user->estado==0){
                        $btn2='<a class="btn btn-secondary" rel="tooltip" data-placement="top" title="Restaurar" onclick="Restaurar('.$user->id.')"><i class="fas fa-arrow-alt-circle-up"></i></a>';
                    }
                    if($user->estado==1){
                        $btn2='<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Eliminar" onclick="Eliminar('.$user->id.')"><i class="far fa-trash-alt"></i></a>';
                    }
                     $btn= '<div class="btn-group btn-group-sm">'
                     .'<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Editar" onclick="Modificar('.$user->id.')" ><i class="far fa-edit"></i></a>'
                     .$btn2
                     .'</div>';
                   return  $btn;
                 })
                // 
                ->addColumn('foto', function($user){
                    $imagen='imagenes/usuarios/'.$user->id.'.jpg';
                     if (!file_exists($imagen)) {
                      $imagen = "imagenes/usuarios/150x150.png";
                     }
                    $url=asset($imagen.'?'.time());
                    $r="'";
                    return  ' <a class="btn btn-sm" rel="tooltip" data-placement="top" title="Ver imagen" onclick="Imagen('.$r.$url.$r.')">  <div class="text-center" > <img width="50" height="30" src="'.$url.'"/> </div> </a>';
                 
                })
                ->addColumn('rol_uso' , function($user){
                    if (isset($user->roles['0']->name)){
                    return $user->roles['0']->name;
                    }else{
                       return 'no tiene rol';
                    }
                })
                ->addColumn('estado', function($user){

                    if($user->estado==0){
                        $span= '<span class="badge bg-danger">: inactivo</span>';
                    }
                    if($user->estado==1){
                        $span= '<span class="badge bg-success">: activo</span>';
                    }

                  return  $span;
                 })
                 ->rawColumns(['actions','foto','rol_uso','estado']) // incorporar columnas
                 ->make(true); // convertir a codigo
        }
    }
    public function DatosServerSideInactivo(Request $request){
        if ($request->ajax()) {
             $user=User::select('users.*')->with('roles')
             ->where('users.estado','=',0);
             return DataTables::of($user)
                // anadir nueva columna botones
                 ->addColumn('actions', function($user){
                    if($user->estado==0){
                        $btn2='<a class="btn btn-secondary" rel="tooltip" data-placement="top" title="Restaurar" onclick="Restaurar('.$user->id.')"><i class="fas fa-arrow-alt-circle-up"></i></a>';
                    }
                    if($user->estado==1){
                        $btn2='<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Eliminar" onclick="Eliminar('.$user->id.')"><i class="far fa-trash-alt"></i></a>';
                    }
                     $btn= '<div class="btn-group btn-group-sm">'
                     .'<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Editar" onclick="Modificar('.$user->id.')" ><i class="far fa-edit"></i></a>'
                     .$btn2
                     .'</div>';
                   return  $btn;
                 })
                // 
                ->addColumn('foto', function($user){
                    $imagen='imagenes/usuarios/'.$user->id.'.jpg';
                     if (!file_exists($imagen)) {
                      $imagen = "imagenes/usuarios/150x150.png";
                     }
                    $url=asset($imagen.'?'.time());
                    $r="'";
                    return  ' <a class="btn btn-sm" rel="tooltip" data-placement="top" title="Ver imagen" onclick="Imagen('.$r.$url.$r.')">  <div class="text-center" > <img width="50" height="30" src="'.$url.'"/> </div> </a>';
                 
                })
                ->addColumn('rol_uso' , function($user){
                    if (isset($user->roles['0']->name)){
                    return $user->roles['0']->name;
                    }else{
                       return 'no tiene rol';
                    }
                })
                ->addColumn('estado', function($user){

                    if($user->estado==0){
                        $span= '<span class="badge bg-danger">: inactivo</span>';
                    }
                    if($user->estado==1){
                        $span= '<span class="badge bg-success">: activo</span>';
                    }

                  return  $span;
                 })
                 ->rawColumns(['actions','foto','rol_uso','estado']) // incorporar columnas
                 ->make(true); // convertir a codigo
        }
    }

     
    public function perfil()
    {
        return view('usuarios/perfil');
    }

    public function store(Request $request)
    {
        $data['error']=0;
        $data['error_email']=0;
        $data['error_password']=0;
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer|min:2',
            'telefono' => 'required|digits_between: 1,9',
            'apellidos' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
           //'img_perfil' => 'image|mimes:jpg,jpeg',
            'password' => 'required|string|min:2|confirmed',
            'email' => 'required|string|email|max:255|unique:users',
            'id_rol2' => 'required',
        ]);

        if($validator->fails())
        {
            if(Validator::make($request->all(),['email' => 'unique:users'])->fails()){
                $data=['error_email'=>'1','mensaje'=> $request->email." ya existe"];
                return $data;
            }
            if(Validator::make($request->all(),['password' => 'confirmed'])->fails()){
                $data=['error_password'=>'1','mensaje'=> "password no coinciden"];
                return $data;
            }
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }

        $usuario=User::create([
            'name'=> $request->nombre,
            'email' => $request->email,
            'apellidos'=> $request->apellidos,
            'edad'=> $request->edad,
            'direccion'=> $request->direccion,
            'telefono'=> $request->telefono,
            'password' => Hash::make($request->password),
        ])->assignRole($request->id_rol2);
        if ($request->hasFile("img_foto")) {//existe un campo de tipo file?
            $imagen = $request->file("img_foto"); //almacenar imagen en variable
            $nombreimagen=Str::slug($usuario->id).".".$imagen->guessExtension();//insertar parametro del nombre de imagen
            $ruta = public_path("imagenes/usuarios/");//guardar en esa ruta
            $imagen->move($ruta,$nombreimagen); //mover la imagen es esa ruta y con ese nombre      
        }
        return $data;     
    }

    public function update_perfil(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer|min:2',
            'telefono' => 'required|digits_between: 1,9',
            'apellidos' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'img_perfil' => 'image|mimes:jpg,jpeg'
        ]);

        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }
        
        $id=Auth::user()->id; // extraemos el id del user logeado
        $user=User::findOrFail($id);
        $user->name=$request->nombre;
        $user->apellidos=$request->apellidos;
        $user->edad=$request->edad;
        $user->telefono=$request->telefono;
        $user->direccion=$request->direccion;
        $user->update();

        //script para subir editar una imagen
        if ($request->hasFile("img_perfil")) {
            $image_path = public_path("imagenes/usuarios/{$id}.jpg");
            if (File::exists($image_path)) {
                File::delete($image_path);  //eliminar imagen existente
            }
            
            $imagen = $request->file("img_perfil");
            $nombreimagen =  $id.".jpg";
            $ruta = public_path("imagenes/usuarios/");
            $imagen->move($ruta,$nombreimagen);
        }
        return $request;
    }

    public function update_password(Request $request)
    {   
        $id=Auth::user()->id; // extraemos el id del user logeado
        $user=User::findOrFail($id);
         if (Hash::check($request->contrase??a,$user->password)){
            if($request->nueva_contrase??a == $request->confirmar_nueva_contrase??a){
                if (Hash::check($request->nueva_contrase??a,$user->password)){
                    $data=['error'=>'1','mensaje'=>'contrase??a nueva es la misma'];
                    return $data;   
                }else{
                    $user->password=Hash::make($request->nueva_contrase??a);
                    $user->update();
                    $data=['error'=>'0','mensaje'=>''];
                    return $data;
                }
            }else{
                $data=['error'=>'1','mensaje'=>'son diferentes contrase??as ingresadas'];
                return $data;
            }
         }else{
            $data=['error'=>'1','mensaje'=>'su contrase??a actual no esta correcta'];
            return $data;
         } 
    }
    public function update(Request $request,$id)
    {
        $data['error']=0;
        $validator = Validator::make($request->all(), [
            'id_rol_nuevo' => 'required',
        ]);

        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }

        $user=User::findOrFail($id);

        $user->removeRole($request->id_rol_antiguo);
        $user->assignRole($request->id_rol_nuevo);

        return $data;
    }

    public function buscarPoUsuario($id){
        if ($id==-1){ //  cuando requiera los roles para crear un usuario
           // $role = Role::all()->where('activo','=',1);
            $role =Role::select('roles.*')->where('roles.activo','=',1)->get();
            $res['roles']=$role;
            return json_encode($res);
        }else{
        $user=User::findOrFail($id);
        $id_rol_user = User::with('roles')->where('id',$id)->first();
        $id_rol_user = $id_rol_user->roles['0']->id;
        $role = Role::all();
        $res['datos']=$user;
        $res['roles']=$role;
        $res['id_rol_user']=$id_rol_user;
        echo json_encode($res);
        }
    }

    public function restore($id)
    {
        $user = User::findOrFail($id);
        $user->estado = 1;
        $user->update();
    }

    public function destroy($id)
    { 
      $user = User::findOrFail($id);
      $user->estado = 0;
      $user->update();
    }
}
