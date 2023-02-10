<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('roles.index');
    }

    public function DatosServerSideActivo(Request $request){
        if ($request->ajax()) {
            $roles=Role::select('roles.*')
            ->get();
            return DataTables::of($roles)
            // anadir nueva columna botones
                ->addColumn('actions', function($roles){
                    if($roles->activo==0){
                        $btn2='<a class="btn btn-secondary" rel="tooltip" data-placement="top" title="Restaurar" onclick="Restaurar('.$roles->id.')"><i class="fas fa-arrow-alt-circle-up"></i></a>';
                    }
                    if($roles->activo==1){
                        $btn2='<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Eliminar" onclick="Eliminar('.$roles->id.')"><i class="far fa-trash-alt"></i></a>';
                    }
                    $url= route('rol.permisos',$roles->id);
                // $url2= route('rol.destroy', $roles->id);
                    $btn= '<div class="btn-group btn-group-sm">'
                    .'<a class="btn btn-success" rel="tooltip" data-placement="top" title="Permiso" href="'.$url.'" ><i class="fa fa-tasks"></i></a>'
                    .'<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Editar" onclick="Modificar('.$roles->id.')" ><i class="far fa-edit"></i></a>'
                    .$btn2
                    .'</div>';
                return  $btn;
                })
                ->addColumn('estado', function($roles){

                    if($roles->activo==0){
                        $span= '<span class="badge bg-danger">: inactivo</span>';
                    }
                    if($roles->activo==1){
                        $span= '<span class="badge bg-success">: activo</span>';
                    }

                  return  $span;
                 })
            // 
                ->rawColumns(['actions','estado']) // incorporar columnas
                ->make(true); // convertir a codigo
         }
    }

    public function DatosServerSideInactivo(Request $request){
        if ($request->ajax()) {
            $roles=Role::select('roles.*')->where('roles.activo','=',0);
             return DataTables::of($roles)
                // anadir nueva columna botones
                 ->addColumn('actions', function($roles){
                     $url= route('rol.permisos',$roles->id);
                     $btn= '<div class="btn-group btn-group-sm">'
                     .'<a class="btn btn-success" rel="tooltip" data-placement="top" title="Permiso" href="'.$url.'" ><i class="far fa-edit"></i></a>'
                     .'<a class="btn btn-secondary" rel="tooltip" data-placement="top" title="Restaurar" onclick="Restaurar('.$roles->id.')"><i class="fas fa-arrow-alt-circle-up"></i></a>
                     </div>';
                   return  $btn;
                 })
                // 
                 ->rawColumns(['actions']) // incorporar columnas
                 ->make(true); // convertir a codigo
        }
    }

    public function store(Request $request)
    {   $data['error']=0;
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:200',
        ]);

        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }

        Role::create([
            'name'=> $request->nombre,
            'descripcion'=> $request->descripcion,
        ]);
        return $data;
    }

    public function update(Request $request, $id)
    {   
        $data['error']=0;
        $validator = Validator::make($request->all(), [
            'nombre_modal_rol' => 'required|string|max:255',
            'descripcion_modal_rol' => 'required|string|max:200',
        ]);

        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }   
        $role = Role::findOrFail($id);
        $role->name = $request->nombre_modal_rol;
        $role->descripcion= $request->descripcion_modal_rol;
        $role->update();
        return $data;
    }

    
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->activo = 0;
        $role->update();
        
    }

    public function restore($id)
    {
        $role = Role::findOrFail($id);
        $role->activo = 1;
        $role->update();
    }

    public function buscarPorRol($id)
    {  
        $res = Role::findOrFail($id);
        echo json_encode($res);  
    }

    public function permiso_rol($id){
       $role = Role::findOrFail($id);
       $role= $role->permissions;
       $permisos=Permission::all();
       return view('roles.permisos',compact('role','permisos','id'));

    }

    public function update_permisos(Request $request, $id)
    { 
        $num=collect($request->permisos);
        $n=count($num);
        if($n != 0){
        $role = Role::findOrFail($id); // rol a modificar sus permisos
        $permiso=Permission::whereIn('id', $request->permisos)->get(); // traemos todos los registros con un array de $reques q contiene id de permisos
        $role->syncPermissions($permiso);// metodo para asiganr array de permisos a un rol

        return view('roles.index');
        }else{
            return "POR FAVOR DEBE TENER HABILITADO POR LO MENOS 1";
        }

    }
}
