<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Egreso;
use Illuminate\Http\Request;
use App\Models\Gestion;
use App\Models\Ingreso;
use App\Models\Socio;
use App\Models\Tipo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;

class GestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('gestion/index');
    }

    public function DatosServerSideActivo(Request $request){
        if ($request->ajax()) {   
            $gestion=Gestion::select('gestions.*')
           // ->where('gestions.activo','=',1)
            ->whereIn('gestions.activo',[1,-1])
            ->where('id_usuario','=',Auth::user()->id)
            ->orderBy('gestions.created_at','desc');

            return DataTables::of($gestion)
                // anadir nueva columna botones
                 ->addColumn('actions', function($gestion){
                    $url1= route('gestion.gasto',[$gestion->id,'0']);
                    $url2= route('reporte.gestion',[$gestion->id,'0']);
                    $button2= '<a class="btn btn-danger" rel="tooltip" data-placement="top" title="Reporte PDF" href="'.$url2.'" ><i class="fas fa-file-pdf"></i></a>';
                    if($gestion->activo==1){
                        $button='<a class="btn btn-outline-success intermitente" rel="tooltip" data-placement="top" title="Gastos Caja" href="'.$url1.'" ><i class="fas fa-balance-scale-right"></i></a>';
                    }
                    if($gestion->activo==-1)
                    {
                        $button='<a class="btn btn-outline-success" rel="tooltip" data-placement="top" title="Gastos Caja" href="'.$url1.'" ><i class="fas fa-balance-scale-right"></i></a>';  
                    }
                   
                     $btn= '<div class="btn-group btn-group-sm">'
                     .$button2
                     .$button
                     .'<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Editar" onclick="Modificar('.$gestion->id.')" ><i class="far fa-edit"></i></a>'
                     .'<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Eliminar" onclick="Eliminar('.$gestion->id.')"><i class="far fa-trash-alt"></i></a>
                     </div>';
                   return  $btn;
                 })
                 ->addColumn('estado', function($gestion){
                    $span='';
                    if($gestion->estado==0){
                        $span= '<span class="badge bg-success">en curso</span>';
                    }
                    if($gestion->estado==1){
                        $span= '<span class="badge bg-danger">finalizado</span>';
                    }
                    if($gestion->estado==-1){
                        $span= '<span class="badge bg-warning">obserbaciones</span>';
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
           // $gestion=Gestion::select('gestions.*')->where('gestions.activo','=',0);
            $gestion=Gestion::select('gestions.*')
           // ->where('gestions.activo','=',1)
            ->whereIn('gestions.activo',[0])
            ->where('id_usuario','=',Auth::user()->id)
            ->orderBy('gestions.created_at','desc');
            
             return DataTables::of($gestion)
                // anadir nueva columna botones
                 ->addColumn('actions', function($gestion){  
                     $btn= ' <div class="text-right">  <div class="btn-group btn-group-sm">'
                     .'<a class="btn btn-secondary" rel="tooltip" data-placement="top" title="Restaurar" onclick="Restaurar('.$gestion->id.')"><i class="fas fa-arrow-alt-circle-up"></i></a>
                     </div> </div>';
                   return  $btn;
                 })
                // 
                ->addColumn('estado', function($gestion){
                    $span='';
                    if($gestion->estado==0){
                        $span= '<span class="badge bg-success">en curso</span>';
                    }
                    if($gestion->estado==1){
                        $span= '<span class="badge bg-danger">finalizado</span>';
                    }
                    if($gestion->estado==-1){
                        $span= '<span class="badge bg-warning">obserbaciones</span>';
                    }
        
                  return  $span;
                })
                 ->rawColumns(['actions','estado']) // incorporar columnas
                 ->make(true); // convertir a codigo
        }
    }


    public function store(Request $request)
    {
        $data['error']=0;
        $validator = Validator::make($request->all(), [
            'gestion' => 'required|string|max:255',
            'descripcion' => 'required|string|max:200',
        ]);

        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }
        $r=  new Gestion();
        $r->nombre=$request->gestion;
        $r->descripcion=$request->descripcion;
        $r->fecha_inicial=date('Y-m-d');
        $r->id_usuario=Auth::user()->id;
        $r->save();
        // creamos su caja de gestion  tipo gestion
        $caja= new Caja();
        $caja->nombre='Caja agro '.$r->nombre.' '.Auth::user()->name;
        $caja->descripcion='sin descripcion colocar Por Favor';
        $caja->monto_total=0;
        $caja->tipo_caja=-1;
        $caja->id_gestion=$r->id;
        $caja->save();
         //creamos el nuevo socio el que creo la caja es el admin de la caja
       $socio= new Socio();
        $socio->id_caja=$caja->id;
        $socio->id_usuario=Auth::user()->id;
        $socio->cargo=1;
        $socio->save();

        return $data; 
    }

    public function buscarPorGestion($id){
        $gestion=Gestion::findOrFail($id);
        $res['datos']=$gestion;
        echo json_encode($res);
    }

    public function update(Request $request,$id)
    {
        $data['error']=0;
        $validator = Validator::make($request->all(), [
            'gestion_modal_gestion' => 'required|string|max:255',
            'descripcion_modal_gestion' => 'required|string|max:200',
        ]);

        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all() 
            return $data;
        }
        $gestion=Gestion::findOrFail($id);
        $gestion->nombre=$request->gestion_modal_gestion;
        $gestion->descripcion=$request->descripcion_modal_gestion;
        /*$gestion->estado=$request->estadoM;
        if ($request->estadoM==1) {
            $gestion->fecha_final=date('Y-m-d');
            $caja=Caja::all()->where('id_gestion','=',$gestion->id)->first();
            $caja->activo=0;
            $caja->update();
        }*/
        $gestion->update();
        return $data;
    }

    public function destroy($id)
    {
        $gestion = Gestion::findOrFail($id);
        $caja = Caja::all()->where('id_gestion','=',$gestion->id)->first();
        if ($gestion->estado!=0){
            $caja->activo=0;
            $caja->update();
            $gestion->activo = 0;
            $gestion->update();
        }else{
           return $data=['error'=>1,'mensaje'=>'no puede eliminar una gestion si sigue en curso']; 
        }

        return $data=['error'=>0,'mensaje'=>'']; 
    }

    public function restore($id)
    {
        $gestion = Gestion::findOrFail($id);
        if($gestion->estado==0){
            $caja = Caja::all()->where('id_gestion','=',$gestion->id)->first();
            $caja->activo=1;
            $caja->update();
        }
        $gestion->activo = 1;
        $gestion->update();
    }

    public function gastos_gestion($id,$sw)
    {   if($sw==0){  // cuando la caja tiene gestion
        $gestion = Gestion::findOrFail($id);
        $gestion->activo = -1;
        $gestion->update();
        $caja=Caja::all()->where('id_gestion','=',$id)->first();
        }
        if($sw==1){ // cuando la caja es personal o grupal
        $caja=Caja::all()->where('id','=',$id)->first();  
        }
        $nombre_caja=$caja->nombre;
        $id_caja=$caja->id;
        $monto_total=$caja->monto_total;
        return view('cajas/gastos',compact('nombre_caja','id_caja','monto_total'));
    }

    public function buscarTipos(){
      // $tipos=Tipo::select('tipos.*')->where('tipos.activo','=',1);
       $tipos=Tipo::all();
       $res['datos']=$tipos;
        echo json_encode($res);
    }

    public function extra()
    {
       $gestion=Gestion::select('gestions.*')
       ->whereIn('gestions.activo',[1,-1])
       ->where('id_usuario','=',Auth::user()->id)
       ->orderBy('gestions.created_at','desc')
       ->get();
       $data=['gestion'=>$gestion];
       echo json_encode($data);  
    }

    public function gestion_global_update($id_gestion)
    {
      // session()->forget('gestion_id');
       session(['gestion_id'=>$id_gestion]);
       //session(['gestion_id'=>$id_gestion]);
       return json_encode(1);  
    }

    public function gestion_global_caja(){
        $data=['error'=>1 ,'monto_global'=>"--",'egreso_global'=>"--",'ingreso_global'=>"--"];
        if( (session()->has('gestion_id')) & (session('gestion_id')!=-1)){
            $caja=Caja::all()->where('id_gestion','=',session('gestion_id'))->first();
            $suma_ingreso=Ingreso::select(
                'ingresos.monto'
            )
            ->where('ingresos.id_caja','=',$caja->id)
            ->sum('ingresos.monto');
            $suma_egreso=Egreso::select(
                'egresos.monto'
            )
            ->where('egresos.id_caja','=',$caja->id)
            ->sum('egresos.monto');

            session(['monto_caja_global'=>$caja->monto_total]);
            session(['monto_ingreso_global'=>$suma_ingreso]);
            session(['monto_egreso_global'=>$suma_egreso]);
            $data=['error'=>0 ,'monto_global'=>$caja->monto_total,'egreso_global'=>$suma_egreso,'ingreso_global'=>$suma_ingreso];
            return json_encode($data); 
        }
        return json_encode($data); 
       // $res['monto']=$caja->monto_total;
       // $res['monto_ingreso']=$suma_ingreso;
       // $res['monto_egreso']=$suma_egreso;
       // echo json_encode($res);
    }



}
