<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App;
use App\Archivo;
use App\Subido;
use App\Persona ;
use App\Conyuge ;
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
    public function expediente($prestamoID){


        $prestamo= Prestamo::with('cliente.persona.conyuge','cliente.empresa','avales','garantias','archivos')->find($prestamoID);
        $cliente=$prestamo->cliente;
        $persona=$cliente->persona;
        $conyuge=$persona->conyuge;
        $empresa=$cliente->empresa;
        $avales=$prestamo->avales;
        $garantias=$prestamo->garantias;
        $archivos=$prestamo->archivos;
        if(Storage::disk('local')->exists('/public/'.$cliente->documento.'_'.$cliente->id.'/general/documento/adjunto_'.$cliente->documento.'.pdf')){
            if(Storage::disk('local')->delete('/public/'.$cliente->documento.'_'.$cliente->id.'/general/documento/adjunto_'.$cliente->documento.'.pdf')){

                if(Storage::disk('local')->exists('/public/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/documento/solicitud_credito.pdf')){
                    if(Storage::disk('local')->delete('/public/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/documento/solicitud_credito.pdf')){

                    }
                }
            }

        }     
        
        $pdf = \PDF::loadView('reportes.prestamo',compact('prestamo','cliente','avales','garantias','persona','conyuge','prestamo'));
        Storage::put('public/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/documento/solicitud_credito.pdf', $pdf->output());

        $pdf = new \LynX39\LaraPdfMerger\PdfManage;
        $pdf->addPDF(public_path('/storage/'.$cliente->documento.'_'.$cliente->id.'/general/documento/inscripcion_de_socio.pdf'), 'all');
        $pdf->addPDF(public_path('/storage/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/documento/solicitud_credito.pdf'), 'all');

        foreach ($archivos as $ep=>$rp) {
            if($rp->tipo=='documento'){

                $pdf->addPDF(public_path('/storage/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/'.$rp->tipo.'/'.$rp->nombre.'.'.$rp->extension), 'all');
            }
        }
        foreach ($archivos as $ep=>$rp) {
            if($rp->tipo=='imagen'){
                $pdf->addPDF(public_path('/storage/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/imagenpdf/'.$rp->nombre.'.pdf'), 'all');
            }
        }

        $pdf->merge("archivo_adjunto.pdf", "download");
    }
}
  