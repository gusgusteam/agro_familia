<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Egreso;
use App\Models\User;
use App\Models\Gestion;
use App\Models\Ingreso;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

//use PDF;


class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        $cajas=Caja::all();
       
        // gestion 
        $gestiones=Gestion::select('gestions.*')
        ->whereIn('gestions.activo',[1,-1])
        ->where('id_usuario','=',Auth::user()->id)
        ->orderBy('gestions.created_at','desc')
        ->get();
        //
        return view('reportes/index',compact('cajas','gestiones'));
    }

    public function pdf_usuario(Request $request)
    {
        if ($request->usuario_option==1){
         $user=User::all()->where('estado',1);
        }
        if($request->usuario_option==0){
            $user=User::all()->where('estado',0);
        }
        $mytime = Carbon::now();

       
            $pdf = new Fpdf('P','mm',array(200,200));
            $sw=1;
            $contador = 1;
            foreach ($user as $row){
                if ($sw==1){
                    $pdf->AddPage();
                    $pdf->SetMargins(5,5,5);
                    $pdf->SetTitle("Usuarios PDF");
                    $pdf->SetFont('Arial','B',11);
                    $pdf->image(asset('vendor/adminlte/dist/img/AdminLTELogo.png'),5,4,9,8,'PNG');
                    $pdf->Cell(190,4,'',0,1,'C');
                    $pdf->Cell(190,4,'Lista De Usuarios',0,1,'C');
                    $pdf->Ln(6);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->SetFont('Arial','',9);
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(17,5,utf8_decode('Dirección: '),0,0,'L');
                    $pdf->SetFont('Arial','',9);
                    $pdf->Cell(50,5,'San Jose Del Norte/Barrio 24 de septiembre',0,1,'L');
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(22,5,utf8_decode('Fecha y hora: '),0,0,'L');
                    $pdf->SetFont('Arial','',9);
                    $pdf->Cell(50,5,$mytime->toDateTimeString(),0,1,'L');
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(22,5,utf8_decode('Remitente: '),0,0,'L');
                    $pdf->SetFont('Arial','',9);
                    $pdf->Cell(50,5,''.Auth::user()->name.''.' '.''.Auth::user()->apellidos.'',0,1,'L');
                    $pdf->Cell(70,2,'',0,1,'C');
                   // $pdf->SetFont('Arial','',9); 
                    $pdf->SetFont('Arial','B',11);
                    $pdf->Ln(10);
                    $pdf->SetFillColor(2,157,116);//Fondo verde de celda
                    $pdf->SetTextColor(240, 255, 240); //Letra color blanco
                    $pdf->Cell(14,5,utf8_decode('Nº'),1,0,'L',true);
                    $pdf->Cell(51,5,utf8_decode('Nombre'),1,0,'L',true);
                    $pdf->Cell(51,5,utf8_decode('Apellidos'),1,0,'L',true);
                    $pdf->Cell(14,5,utf8_decode('Edad'),1,0,'L',true);
                    $pdf->Cell(28,5,utf8_decode('Direccion'),1,0,'L',true);
                    $pdf->Cell(28,5,utf8_decode('Telefono'),1,1,'L',true);
                    $pdf->SetFont('Arial','',11);
                    $sw=0;
                }
                $pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
                $pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
                $pdf->Cell(14,5,$contador,1,0,'L');
                $pdf->Cell(51,5,$row['name'],1,0,'L');
                $pdf->Cell(51,5,utf8_decode($row['apellidos']),1,0,'L');
                $pdf->Cell(14,5,utf8_decode($row['edad']),1,0,'L');
                $pdf->Cell(28,5,$row['direccion'],1,0,'L');
                $pdf->Cell(28,5,$row['telefono'],1,1,'L');
                if ($contador%24==0){$sw=1;}
                $contador++;
            }
            $pdf->Output("D",$mytime->toDateTimeString().'informe de usuarios.pdf');
    }

    public function pdf_rol(Request $request)
    {
        if ($request->rol_option==1){
            $role=Role::all()->where('activo',1);
        }
        if($request->rol_option==0){
            $role=Role::all()->where('activo',0);
        }
        $mytime = Carbon::now();
         

       
            $pdf = new FPDF('P','mm',array(200,200));
            $sw=1;
            $contador = 1;
            $color=0;
            foreach ($role as $row){
                if ($sw==1){
                    $pdf->AddPage();
                    $pdf->SetMargins(5,5,5);
                    $pdf->SetTitle("Roles PDF");
                    $pdf->SetFont('Arial','B',11);
                    $pdf->image(asset('vendor/adminlte/dist/img/AdminLTELogo.png'),5,4,9,8,'PNG');
                    $pdf->Cell(190,4,'',0,1,'C');
                    $pdf->Cell(190,4,'Lista De Roles',0,1,'C');
                    $pdf->Ln(6);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->SetFont('Arial','',9);
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(17,5,utf8_decode('Dirección: '),0,0,'L');
                    $pdf->SetFont('Arial','',9);
                    $pdf->Cell(50,5,'San Jose Del Norte/Barrio 24 de septiembre',0,1,'L');
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(22,5,utf8_decode('Fecha y hora: '),0,0,'L');
                    $pdf->SetFont('Arial','',9);
                    $pdf->Cell(50,5,$mytime->toDateTimeString(),0,1,'L');
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(22,5,utf8_decode('Remitente: '),0,0,'L');
                    $pdf->SetFont('Arial','',9);
                    $pdf->Cell(50,5,''.Auth::user()->name.''.' '.''.Auth::user()->apellidos.'',0,1,'L');
                    $pdf->Cell(70,2,'',0,1,'C');
                   // $pdf->SetFont('Arial','',9); 
                    $pdf->SetFont('Arial','B',11);
                    $pdf->Ln(10);
                    $pdf->SetFillColor(2,157,116);//Fondo verde de celda
                    $pdf->SetTextColor(240, 255, 240); //Letra color blanco
                    $pdf->Cell(14,5,utf8_decode('Nº'),1,0,'L',true);
                    $pdf->Cell(51,5,utf8_decode('Nombre'),1,0,'L',true);
                    $pdf->MultiCell(52,5,utf8_decode('Descripcion'),1,1,'L',true);
                    $pdf->SetFont('Arial','',11);
                   // $pdf->Ln(5);
                    $sw=0;
                }

                if($color==1){
                $pdf->SetFillColor(229, 232, 232 ); //gris tenue de cada fila
                $pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
                $color=0;
                }else{
                $pdf->SetFillColor(255, 255, 255 ); //blanco tenue de cada fila
                $pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
                $color=1;
                }

                $pdf->Cell(14,5,$contador,'LR',0,'L',true);
                $pdf->Cell(51,5,$row['name'],'LR',0,'L',true);
                $pdf->Cell(52,5,utf8_decode($row['descripcion']),'LR',1,'L',true); // L= IZQUIERDA R= DERECHA
               // $pdf->Ln(); // SALTO DE LINEA
               // $pdf->Cell(14,5,$contador,0,0,'L');
               // $pdf->Cell(51,5,utf8_decode($row['name']),0,0,'L');
              //  $pdf->Cell(51,5,utf8_decode($row['descripcion']),0,1,'L');
               // $pdf->multiCell(51,5,utf8_decode($row['descripcion']),'B',1,'C',1);
               // $pdf->Cell(116,0,'',1,1,'L'); // salto de linea blanco
               //   $pdf->Cell(116,0,'',1,1,'L');
               // $pdf->Line(52, 105.5, 180, 105.5);
              
                if ($contador%24==0){$sw=1;}
                $contador++;
            }
            $pdf->Output('I','informe de usuarios.pdf');
    }

    public function pdf_caja(Request $request)
    {
        $cajas_marcados=collect($request->id_caja);
        $n=count($cajas_marcados);
        if($n != 0){
            $i=0;
            $mytime = Carbon::now(); // capturamos fecha
            while ($i<$n) {
                $caja=Caja::all()->where('id','=',$cajas_marcados[$i])->first();
                
                $i=$i+1;
        
            $pdf = new FPDF('P','mm',array(200,200));
            $sw=1;
            $contador = 1;

            foreach ($caja as $row){
                if ($sw==1){
                    $pdf->AddPage();
                    $pdf->SetMargins(5,5,5);
                    $pdf->SetTitle("Cajas PDF");
                    $pdf->SetFont('Arial','B',11);
                    $pdf->image(asset('vendor/adminlte/dist/img/AdminLTELogo.png'),5,4,9,8,'PNG');
                    $pdf->Cell(190,4,'',0,1,'C');
                    $pdf->Cell(190,4,'Informe de '.$row->nombre,0,1,'C');
                    $pdf->Ln(6);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->SetFont('Arial','',9);
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(17,5,utf8_decode('Dirección: '),0,0,'L');
                    $pdf->SetFont('Arial','',9);
                    $pdf->Cell(50,5,'San Jose Del Norte/Barrio 24 de septiembre',0,1,'L');
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(22,5,utf8_decode('Fecha y hora: '),0,0,'L');
                    $pdf->SetFont('Arial','',9);
                    $pdf->Cell(50,5,$mytime->toDateTimeString(),0,1,'L');
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Cell(22,5,utf8_decode('Remitente: '),0,0,'L');
                    $pdf->SetFont('Arial','',9);
                    $pdf->Cell(50,5,''.Auth::user()->name.''.' '.''.Auth::user()->apellidos.'',0,1,'L');
                    $pdf->Cell(70,2,'',0,1,'C');
                    $pdf->SetFont('Arial','B',11);
                    $pdf->Ln(10);
                    $pdf->SetFillColor(2,157,116);//Fondo verde de celda
                    $pdf->SetTextColor(240, 255, 240); //Letra color blanco
                    $pdf->Cell(14,5,utf8_decode('Nº'),1,0,'L',true);
                    $pdf->Cell(51,5,utf8_decode('Nombre'),1,0,'L',true);
                    $pdf->Cell(51,5,utf8_decode('Descripcion'),1,1,'L',true);
                    $pdf->SetFont('Arial','',11);
                    $sw=0;
                }
                $pdf->SetFillColor(255, 255, 255); //Gris tenue de cada fila
                $pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
                $pdf->Cell(14,5,$contador,0,0,'L');
                $pdf->Cell(51,5,$row['name'],0,0,'L');
                $pdf->MultiCell(51,5,utf8_decode($row['descripcion']),0,1,'L');
                //$pdf->Cell(200,0,'',1,1,'L');
                if ($contador%24==0){$sw=1;}
                $contador++;
            }
            $pdf->Output("D",$mytime->toDateTimeString().'informe de usuarios.pdf');
        }
    }
    }
    
    public function prueba()
    {
        
    }

    public function prueba2(){
        $pdf = new Fpdf('L');
        $pdf->AddPage();
       // $pdf->SetAutoPageBreak(1, 10); // Corta la pagina en la posicion indicada
       // $pdf->SetMargins(5,5,5);
        $pdf->SetTitle("Usuarios PDF");
        
        $pdf->SetFont('Arial','B',6);

        $pdf->SetFont('','B');
        //$fill = true;

        $pdf->SetXY(10,20);//posicion donde comienza derecha=10 abajo=20
        
        $posicion_MulticeldaDX= $pdf->GetX();//Aquí inicializo donde va a comenzar el primer recuadro en la posición X
        $posicion_MulticeldaDY= $pdf->GetY();//Aquí inicializo donde va a comenzar el primer recuadro en la posición Y

        $pdf->SetDrawColor(0,0,0); // borde color

        $pdf->SetFillColor(2,157,116); // cuadro color verde
        $pdf->SetTextColor(255,255,255); // texto color blanco
        $pdf->SetXY($posicion_MulticeldaDX,$posicion_MulticeldaDY); // posicion del primer cuadro
        $pdf->MultiCell(137,5,'',0,true);
        $pdf->SetXY($posicion_MulticeldaDX,$posicion_MulticeldaDY+5);
        $pdf->Cell(137,5,'EGRESOS',0,1,'C',true);  // 137 es el ancho de multicelda 15 es altura 1 habilita el borde
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);           // texto BLANCO
        $pdf->SetXY($posicion_MulticeldaDX,$posicion_MulticeldaDY+10);
        $pdf->Cell(30,5,'Nro:',1,0,'L',true);
        $pdf->Cell(30,5,'monto',1,0,'L',true);
        $pdf->Cell(77,5,'Descripcion',1,1,'B',true);
        $pdf->SetTextColor(0);

        $caja= Egreso::all();
        
        $n=1;
        $pdf->SetXY($posicion_MulticeldaDX,$posicion_MulticeldaDY+15);
        foreach ($caja as $row){
            
            $pdf->SetFillColor(229, 232, 232 );
            $color=false;
            $pdf->Cell(30,5,$n,0,0,'L',$color);
            $pdf->Cell(30,5,$row->monto,0,0,'L',$color);
            $pdf->MultiCell(77,5,$row->descripcion,'B',0,$color);
            $pdf->SetX($posicion_MulticeldaDX);
            $pdf->Cell(137,0,'',1,1,'L');
            $n+=1;
        }
       
        $pdf->SetFont('Arial','B',6);
        $pdf->SetFont('','B');
        $pdf->SetXY(153,20);//posicion donde comienza derecha=10 abajo=20
        
        $posicion_MulticeldaDX= $pdf->GetX();
        $posicion_MulticeldaDY= $pdf->GetY();
        $pdf->SetDrawColor(0,0,0); // borde color

        $pdf->SetFillColor(2,157,116); // cuadro color verde
        $pdf->SetTextColor(255,255,255); // texto color blanco
        $pdf->SetXY($posicion_MulticeldaDX,$posicion_MulticeldaDY); // posicion del primer cuadro
        $pdf->MultiCell(137,5,'',0);
        $pdf->SetXY($posicion_MulticeldaDX,$posicion_MulticeldaDY+5);
        $pdf->Cell(137,5,'INGRESOS',0,1,'C',true);  // 137 es el ancho de multicelda 15 es altura 1 habilita el borde
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);           // texto BLANCO
        $pdf->SetXY($posicion_MulticeldaDX,$posicion_MulticeldaDY+10);
        $pdf->Cell(30,5,'Nro:',1,0,'L',true);
        $pdf->Cell(30,5,'monto',1,0,'L',true);
        $pdf->Cell(77,5,'Descripcion',1,1,'B',true);
        $pdf->SetTextColor(0);

        $caja2= Ingreso::all();
        
        $n=1;
        $pdf->SetXY($posicion_MulticeldaDX,$posicion_MulticeldaDY+15);
        foreach ($caja2 as $row2){

            $pdf->SetFillColor(229, 232, 232 );
            $color=false;
            $pdf->Cell(30,5,$n,0,0,'L',$color);
            $pdf->Cell(30,5,$row2->monto,0,0,'L',$color);
            $pdf->MultiCell(77,5,$row2->descripcion,'B',0,$color);
            $pdf->SetX($posicion_MulticeldaDX);
            $pdf->Cell(137,0,'',1,1,'L');
            $n+=1;
        }


        
        
        $pdf->Output('D','informe egreso.pdf');
       //$pdf->Output('informe egreso.pdf','I');
       //$pdf->Output('I','informe de usuarios.pdf');

    }

   
    public function reporte_pdf($id , $sw)
    {
        $nombre_gestion="----";
        if($sw==0){  // cuando la caja tiene gestion
            $caja=Caja::all()->where('id_gestion','=',$id)->first();
            $nombre_gestion=Gestion::all()->where('id','=',$id)->first()->nombre;
        }
        if($sw==1){ // cuando la caja es personal o grupal
        $caja=Caja::all()->where('id','=',$id)->first();  
        }
        $nombre_caja=$caja->nombre;
        $id_caja=$caja->id;
        $monto_total=$caja->monto_total;

        
        return view('reportes/pdf_gastos',compact('nombre_caja','id_caja','monto_total','nombre_gestion'));

    }

    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
