<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ReporteController extends Controller
{
   
    public function index()
    {
        return view('reportes/index');
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
                    $pdf->Cell(51,5,utf8_decode('Descripcion'),1,1,'L',true);
                    $pdf->SetFont('Arial','',11);
                    $sw=0;
                }
                $pdf->SetFillColor(255, 255, 255); //Gris tenue de cada fila
                $pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
                $pdf->Cell(14,5,$contador,0,0,'L');
                $pdf->Cell(51,5,$row['name'],0,0,'L');
                $pdf->MultiCell(51,5,utf8_decode($row['descripcion']),0,1,'L');
                $pdf->Cell(116,0,'',1,1,'L');
                if ($contador%24==0){$sw=1;}
                $contador++;
            }
            $pdf->Output("D",$mytime->toDateTimeString().'informe de usuarios.pdf');
    }
    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
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
