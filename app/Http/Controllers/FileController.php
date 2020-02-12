<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App;
use App\Archivo;
use App\Subido;
use App\Cliente;
use Barryvdh\DomPDF\Facade as PDF;
use App\Prestamo;
class FileController extends Controller
{
    private $image_ext = ['jpg', 'jpeg', 'png', 'gif'];
    private $document_ext = ['doc', 'docx', 'pdf', 'odt','txt'];

   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $pretamos = Prestamo::join('clientes','prestamos.cliente_id',"=","clientes.id")
                            ->select('clientes.documento','clientes.id','prestamos.cuantitativa','prestamos.cualitativa','prestamos.estado')
                            ->where('prestamos.id',$id)->first();

        $model = new Archivo();
        $files = $model::where('prestamo_id', $id)->get();


        return ['files'=>$files,'datos'=>$pretamos];

    }
 

    public function store(Request $request)
    {

        $max_size = (int)ini_get('upload_max_filesize') * 1000;
        $all_ext = implode(',', $this->allExtensions());

        $file = $request->file('file');

        $ext = $file->getClientOriginalExtension();
        $type = $this->getType($ext);
        
      \Log::alert($request['prestamo_id']);

        $prestamo= Prestamo::find($request['prestamo_id']);
        $cliente = Cliente::where('id',$prestamo->cliente_id)->first();
        $nombre = $request['name'];
        $extension = $ext;

        if (Storage::putFileAs('/public/' . $this->getUserDir($request['prestamo_id']) .'/prestamo_'.$request['prestamo_id']. '/' . $type . '/', $file, $request['name'] . '.' . $ext)) {
            
            if($type=='imagen'){
                $pdf=PDF::loadView('reportes.imagen',compact('prestamo','cliente','nombre','extension'));
                Storage::put('public/'.$cliente->documento.'_'.$cliente->id.'/prestamo_'.$prestamo->id.'/imagenpdf/'.$request['name'].'.pdf', $pdf->output());
            } 
            
            \Log::alert("asdasd");
            \Log::alert($request['prestamo_id']);

            $archivo = new Archivo;
            $archivo->nombre = $request['name'];
            $archivo->tipo = $type;
            $archivo->extension= $ext;
            $archivo->prestamo_id = $request['prestamo_id'];
            $archivo->save();

            \Log::alert("aaaa");
            \Log::alert($request['prestamo_id']);

        }
 
        return response()->json(false);
    }


    public function destroy($id,$prestamo)
    {
        $file = Archivo::findOrFail($id);

        if (Storage::disk('local')->exists('/public/' . $this->getUserDir($prestamo) . '/prestamo_'.$prestamo.'/'. $file->tipo . '/' . $file->nombre . '.' . $file->extension)) {
            if (Storage::disk('local')->delete('/public/' . $this->getUserDir($prestamo) . '/prestamo_'.$prestamo.'/'. $file->tipo . '/' . $file->nombre . '.' . $file->extension)) {
                
                if($file->nombre== 'inscripcion_de_socio'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->inscripcion_socio=0;
                    $subidos->save();
                }             
                if($file->nombre== 'solicitud_credito'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->solicitud_credito=0;
                    $subidos->save();
                }             
                if($file->nombre== 'reporte_de_central'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->reporte_de_central=0;
                    $subidos->save();
                }             
                if($file->nombre== 'evaluacion_cualitativa'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->evaluacion_cualitativa=0;
                    $subidos->save();
                }             
                if($file->nombre== 'evaluacion_cuantitativa'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->evaluacion_cuantitativa=0;
                    $subidos->save();
                }             
                if($file->nombre== 'copia_dni'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->copia_dni=0;
                    $subidos->save();
                }    
                if($file->nombre== 'recibo_agua_casa'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->recibo_agua_casa=0;
                    $subidos->save();
                }    
                if($file->nombre== 'recibo_luz_casa'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->recibo_luz_casa=0;
                    $subidos->save();
                }

                if($file->nombre == 'titulo_casa'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->titulo_casa=0;
                    $subidos->save();
                }  
                if($file->nombre == 'contrato_alquiler_casa'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->contrato_alquiler_casa=0;
                    $subidos->save();
                }  
                if($file->nombre == 'foto_casa'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->foto_casa=0;
                    $subidos->save();
                }  
                if($file->nombre == 'recibo_agua_negocio'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->recibo_agua_negocio=0;
                    $subidos->save();
                }  
                if($file->nombre == 'recibo_luz_negocio'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->recibo_luz_negocio=0;
                    $subidos->save();
                }  
                if($file->nombre == 'contrato_alquiler_negocio'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->contrato_alquiler_negocio=0;
                    $subidos->save();
                }  
                if($file->nombre == 'boleta_compra'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->boleta_compra=0;
                    $subidos->save();
                }  
                if($file->nombre == 'boleta_venta'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->boleta_venta=0;
                    $subidos->save();
                }  
                if($file->nombre == 'factura_compra'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->factura_compra=0;
                    $subidos->save();
                }  
                if($file->nombre == 'factura_venta'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->factura_venta=0;
                    $subidos->save();
                }
                if($file->nombre == 'fotos_negocio'){
                    $subidos = Subido::where('prestamos_id', $prestamo)->first();
                    $subidos->fotos_negocio=0;
                    $subidos->save();
                } 
                
                
                return response()->json($file->delete());
            }
        }

        return [
            'success' => true,
            'data' => 'Cliente creado',
        ];
    }


    /**
     * Get type by extension
     * @param  string $ext Specific extension
     * @return string      Type
     */
    private function getType($ext)
    {
        if (in_array($ext, $this->image_ext)) {
            return 'imagen';
        }
        if (in_array($ext, $this->document_ext)) {
            return 'documento';
        }
    }

    /**
     * Get all extensions
     * @return array Extensions of all file types
     */
    private function allExtensions()
    {
        return array_merge($this->document_ext);
    }

    /**
     * Get directory for the specific user
     * @return string Specific user directory
     */
    private function getUserDir($id)
    {   
        $prestamo = Prestamo::where('id',$id)->first();
        $cliente = Cliente::where('id',$prestamo->cliente_id)->first();
        return $cliente->documento.'_' . $cliente->id;
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

  