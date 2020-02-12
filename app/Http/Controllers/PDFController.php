<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Prestamo;
use Storage;
class PDFController extends Controller
{
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
