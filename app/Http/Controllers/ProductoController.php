<?php

namespace App\Http\Controllers;

use App\Models\Pempresa;
use App\Models\Ppersona;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Tipo_Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; //Extencion para importar imagen
use Yajra\DataTables\Facades\DataTables;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('productos/index');
    }

    public function DatosServerSideActivo(Request $request){
        if ($request->ajax()) {
             $producto=Tipo_Producto::select(
                'productos.*',
                'tipo__productos.nombre as nombre_tipo'
             )
             ->join('productos','productos.id_tipo_producto','=','tipo__productos.id')->get();
             return DataTables::of($producto)
                // anadir nueva columna botones
                 ->addColumn('actions', function($producto){
                    if($producto->activo==0){
                        $btn2='<a class="btn btn-secondary" rel="tooltip" data-placement="top" title="Restaurar" onclick="Restaurar('.$producto->id.')"><i class="fas fa-arrow-alt-circle-up"></i></a>';
                    }
                    if($producto->activo==1){
                        $btn2='<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Eliminar" onclick="Eliminar('.$producto->id.')"><i class="far fa-trash-alt"></i></a>';
                    }
                  
                     $btn= '<div class="btn-group btn-group-sm">'
                     .'<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Editar" onclick="Modificar('.$producto->id.')" ><i class="far fa-edit"></i></a>'
                     .$btn2.
                     '</div>';
                   return  $btn;
                 })
                 ->addColumn('estado', function($producto){

                    if($producto->activo==0){
                        $span= '<span class="badge bg-danger">: inactivo</span>';
                    }
                    if($producto->activo==1){
                        $span= '<span class="badge bg-success">: activo</span>';
                    }

                  return  $span;
                 })
                 ->addColumn('foto', function($producto){
                    $imagen='imagenes/productos/'.$producto->id.'.png'; 
                    if (!file_exists($imagen)) { // existe la imagen con el nombre del id empleado
                     $imagen = "imagenes/productos/150x150.png";
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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data=['error'=>0];
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required',
            'origen' => 'required',
            'tipo_producto' => 'required|integer',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock_minimo' => 'required|integer',
            'id_proveedor' => 'required|integer',
            'img_foto' => 'required'
        ]);
        
        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }
        
        $producto = new Producto();
        $producto->nombre=$request->nombre;
        $producto->descripcion=$request->descripcion;
        $producto->origen=$request->origen;
        $producto->precio_compra=$request->precio_compra;
        $producto->precio_venta=$request->precio_venta;
        $producto->stock_minimo=$request->stock_minimo;
        $producto->id_proveedor=$request->id_proveedor;
        $producto->id_tipo_producto=$request->tipo_producto;
       // $producto->id_proveedor=0;
        $producto->save();
        // guardar foto
        if ($request->hasFile("img_foto")) {//existe un campo de tipo file?
            $imagen = $request->file("img_foto"); //almacenar imagen en variable
            $nombreimagen=Str::slug($producto->id).".".$imagen->guessExtension();//insertar parametro del nombre de imagen
            $ruta = public_path("imagenes/productos/");//guardar en esa ruta
            $imagen->move($ruta,$nombreimagen); //mover la imagen es esa ruta y con ese nombre    
        }
        
        return $data;
    }

    public function extra(){
        //$proveedor = Proveedor::where('activo','=',1)->get();
        $proveedorempresa=Pempresa::select(
        'pempresas.*',
        'proveedors.telefono',
        'proveedors.correo',
        'proveedors.direccion',        
        'proveedors.activo',
        
        )
        ->join('proveedors','proveedors.id','=','pempresas.id_proveedor')
        ->get();
        $proveedorpersona=Ppersona::select(
        'ppersonas.*',
        'proveedors.telefono',
        'proveedors.correo',
        'proveedors.direccion',        
        'proveedors.activo',
        )
        ->join('proveedors','proveedors.id','=','ppersonas.id_proveedor')
        ->get();
       // $proveedor= Proveedor::all();
        $tipo_producto = Tipo_Producto::where('activo','=',1)->get();
        $data=['proveedorempresa'=>$proveedorempresa ,'proveedorpersona'=>$proveedorpersona , 'tipo_producto' => $tipo_producto];
        return  json_encode($data);
    }

    public function buscar(Producto $producto)
    {
        $imagen='imagenes/productos/'.$producto->id.'.png'; 
        if (!file_exists($imagen)) { // existe la imagen con el nombre del id empleado
            $imagen = "imagenes/productos/150x150.png";
        }
        $url_foto=asset($imagen.'?'.time());
        $datos=['producto'=>$producto,'url_foto'=>$url_foto];
        return json_encode($datos);
    }



    public function catalogo()
    {
        $productos=Tipo_Producto::select(
            'productos.*',
            'tipo__productos.nombre as nombre_tipo'
        )
        ->join('productos','productos.id_tipo_producto','=','tipo__productos.id')
        ->where('productos.activo','=',1)
        ->get();
        
        return view('catalogo',compact('productos'));
    }


    public function update(Request $request, Producto $producto)
    {
        $data=['error'=>'0'];
        $validator = Validator::make($request->all(), [
            'nombre_modal_producto' => 'required|string|max:255',
            'descripcion_modal_producto' => 'required',
            'origen_modal_producto' => 'required',
            'tipo_producto_modal_producto' => 'required|integer',
            'precio_compra_modal_producto' => 'required|numeric|min:0',
            'precio_venta_modal_producto' => 'required|numeric|min:0',
            'stock_minimo_modal_producto' => 'required|integer',
            'id_proveedor_modal_producto' => 'required|integer'
            //'img_foto_modal_producto' => 'required'
        ]);
        
        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }
        $producto->nombre=$request->nombre_modal_producto;
        $producto->descripcion=$request->descripcion_modal_producto;
        $producto->origen=$request->origen_modal_producto;
        $producto->precio_compra=$request->precio_compra_modal_producto;
        $producto->precio_venta=$request->precio_venta_modal_producto;
        $producto->stock_minimo=$request->stock_minimo_modal_producto;
        $producto->id_proveedor=$request->id_proveedor_modal_producto;
        $producto->id_tipo_producto=$request->tipo_producto_modal_producto;
        $producto->update();
        if ($request->hasFile("img_foto_modal_producto")) {//existe un campo de tipo file?
            $imagen = $request->file("img_foto_modal_producto"); //almacenar imagen en variable
            $nombreimagen=Str::slug($producto->id).".".$imagen->guessExtension();//insertar parametro del nombre de imagen
            $ruta = public_path("imagenes/productos/");//guardar en esa ruta
            $imagen->move($ruta,$nombreimagen); //mover la imagen es esa ruta y con ese nombre      
        }
        
        return $data;
    }

    public function destroy(Producto $producto)
    {
      $producto->activo=0;
      $producto->update();
      return $producto;  
    }
    public function restore(Producto $producto)
    {
      $producto->activo=1;
      $producto->update();
      return $producto;  
    }
}
