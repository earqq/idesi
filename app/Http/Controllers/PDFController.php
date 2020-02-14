<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App;
use App\Archivo;
use App\Subido;
use App\Persona;
use App\Empresa;
use App\RepresentanteLegal;
use App\Conyuge ;
use App\Cualitativa;
use App\Cuantitativa;
use App\Aval ;
use App\Garantia ;
use App\Cliente;
use Barryvdh\DomPDF\Facade as PDF;
use App\Prestamo;
class PDFController extends Controller
{
 
    public function solicitudCredito($prestamoID){

        $prestamo= Prestamo::find($prestamoID);
        $cliente = Cliente::where('id',$prestamo->cliente_id)->first(); 

        if($cliente->tipo_cliente == 2 ){

            $empresa = Empresa::where('cliente_id',$cliente->id)->first();
            $representante = RepresentanteLegal::where('empresa_id',$empresa->id)->first();

            $avales = Aval::where('prestamo_id',$prestamo->id)->get();
            $garantias = Garantia::where('prestamo_id',$prestamo->id)->get();
            // $evaluacion = Evaluacion::where('prestamos_id',$prestamo->id)->get();

            $pdf = \PDF::loadView('reportes.prestamo',compact('prestamo','cliente','avales','garantias','empresa','representante'));
            return $pdf->stream('solicitud_de_credito.pdf');

        }
        else
        {
            $persona = Persona::where('cliente_id',$cliente->id)->first();
            $conyuge = Conyuge::where('persona_id',$persona->id)->first();

            // return $persona;
            $avales = Aval::where('prestamo_id',$prestamo->id)->get();
            $garantias = Garantia::where('prestamo_id',$prestamo->id)->get();
            // $evaluacion = Evaluacion::where('prestamo_id',$prestamo->id)->get();
    
            $pdf = \PDF::loadView('reportes.prestamo',compact('prestamo','cliente','avales','garantias','persona','conyuge'));
            return $pdf->stream('solicitud_de_credito.pdf');

        }
    }
    public function inscripcionCliente($clienteID){
        $cliente=Cliente::find($clienteID);
        $filename=$cliente->documento.'/inscripcion_de_socio.pdf';
        if (Storage::disk('s3')->exists('clientes/'.$filename))
        {
            $file = Storage::disk('s3')->get('clientes/'.$filename);
            $headers = [
                'Content-Type' => 'application/pdf', 
                'Content-Description' => 'File Transfer',
                'Content-Disposition' => "attachment; filename=".$filename,
            ];
            return response($file, 200, $headers); 
        }	    
        else return "Archivo no encontrado";

    }
    public function cualitativa($prestamoID){

        $cualitativa= Cualitativa::where('prestamo_id',intval($prestamoID))->first();  
        $pdf = \PDF::loadView('reportes.cualitativa',compact('cualitativa'));
        return $pdf->stream('evaluacion_cualitativa.pdf');

    }

    public function cuantitativa($prestamoID){

        $cuantitativa= Cuantitativa::where('prestamo_id',intval($prestamoID))->first();        
        $pdf = \PDF::loadView('reportes.cuantitativa',compact('cuantitativa'));
        return $pdf->stream('evaluacion_cuantitativa.pdf');

    }
    public function archivos($archivoID)
    {                
        $archivo= Archivo::with('prestamo.cliente')->find($archivoID);        
        $prestamo= $archivo->prestamo;
        $cliente=$prestamo->cliente;
        $filename=$cliente->documento.'/prestamo_'.$prestamo->id.'/'.$archivo->nombre.'.'.$archivo->extension;
        if (Storage::disk('s3')->exists('clientes/'.$filename))
        {
            $file = Storage::disk('s3')->get('clientes/'.$filename);
            $headers = [
                'Content-Type' => 'application/pdf', 
                'Content-Description' => 'File Transfer',
                'Content-Disposition' => "attachment; filename=".$filename,
            ];
            return response($file, 200, $headers); 
        }	    
        else return "Archivo no encontrado";
    }
    public function expediente($prestamoID){
        $prestamo= Prestamo::with('cliente.persona.conyuge','cliente.empresa.representante','avales','garantias','archivos')->find($prestamoID);
        $cliente=$prestamo->cliente;
        $persona=$cliente->persona;
        $conyuge='';
        if($cliente->persona)
        $conyuge=$persona->conyuge;
        $empresa=$cliente->empresa;
        $avales=$prestamo->avales;
        $garantias=$prestamo->garantias;
        $archivos=$prestamo->archivos;               
        $pdfMerge = new \LynX39\LaraPdfMerger\PdfManage;
        //Inscripcion de socio
        $pdfFile = Storage::disk('s3')->get('clientes/'.$cliente->documento.'/inscripcion_de_socio.pdf');                
        Storage::disk('public')->put('/expedientes/'.$cliente->documento.'/inscripcion_de_socio.pdf',$pdfFile->output());
        $pdfMerge->addPDF(public_path('/expedientes/'.$cliente->documento.'/inscripcion_de_socio.pdf'), 'all');
        //Solicitud de crédito
        $pdfFile = \PDF::loadView('reportes.prestamo',compact('prestamo','cliente','avales','garantias','persona','conyuge','empresa'));
        Storage::disk('public')->put('/expedientes/'.$cliente->documento.'/solicitud_credito.pdf',$pdfFile->output());
        $pdfMerge->addPDF(public_path('/expedientes/'.$cliente->documento.'/solicitud_credito.pdf'), 'all');        
        //cualitativa
        if($prestamo->cualitativa){
            $cualitativa= Cuantitativa::where('prestamo_id',intval($prestamoID))->first();        
            $pdfFile = \PDF::loadView('reportes.cualitativa',compact('cualitativa'));
            Storage::disk('public')->put('/expedientes/'.$cliente->documento.'/evaluacion_cualitativa.pdf', $pdfFile->output());
            $filepath=public_path('/expedientes/'.$cliente->documento.'/evaluacion_cualitativa.pdf');
            $pdfMerge->addPDF($filepath, 'all');
        }
        //Cuantitativa
        if($prestamo->cuantitativa){
            $cuantitativa= Cuantitativa::where('prestamo_id',intval($prestamoID))->first();        
            $pdfFile = \PDF::loadView('reportes.cuantitativa',compact('cuantitativa'));
            Storage::disk('public')->put('/expedientes/'.$cliente->documento.'/evaluacion_cuantitativa.pdf', $pdfFile->output());
            $filepath=public_path('/expedientes/'.$cliente->documento.'/evaluacion_cuantitativa.pdf');
            $pdfMerge->addPDF($filepath, 'all');
        }
        //Descargando archivos
        foreach ($archivos as $archivo) {                                                
            $filename=$cliente->documento.'/prestamo_'.$prestamo->id.'/'.$archivo->nombre.'.'.$archivo->extension;
            if (Storage::disk('s3')->exists('clientes/'.$filename))
            {
                $file = Storage::disk('s3')->get('clientes/'.$filename);                
                Storage::disk('public')->put('/expedientes/'.$cliente->documento.'/'.$archivo->nombre.'.'.$archivo->extension,$file);
            }	    
        }
        //Juntando archivos
        foreach ($archivos as $archivo) {                                                
            $filepath=public_path('/expedientes/'.$cliente->documento.'/'.$archivo->nombre.'.'.$archivo->extension);
            $pdfMerge->addPDF($filepath, 'all');
        }
        Storage::disk('public')->deleteDirectory('/expedientes/'.$cliente->documento);
        $pdfMerge->merge("archivo_adjunto.pdf", "download");
    }
}
  