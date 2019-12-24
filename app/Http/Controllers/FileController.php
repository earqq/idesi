<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App;
use App\Archivo;
use App\Subido;
use App\Cliente;
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
        $pretamos = Prestamo::join('clientes','prestamos.clientes_id',"=","clientes.id")
                            ->select('clientes.documento','clientes.id')
                            ->where('prestamos.id',$id)->first();

        $model = new Archivo();
        $files = $model::where('prestamos_id', $id)->get();

        $subidos = Subido::where('prestamos_id', $id)->first();

        return ['files'=>$files,'datos'=>$pretamos,'subidos'=>$subidos];

    }


    public function store(Request $request)
    {

        $max_size = (int)ini_get('upload_max_filesize') * 1000;
        $all_ext = implode(',', $this->allExtensions());

        
        // $this->validate($request, [
        //     'nombre' => 'required|unique:files',
        //     'file' => 'required|file|mimes:' . $all_ext . '|max:' . $max_size
        // ]);


        $model = new Archivo(); 

        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $type = $this->getType($ext);
 

        if (Storage::putFileAs('/public/' . $this->getUserDir($request['prestamo_id']) .'/prestamo_'.$request['prestamo_id']. '/' . $type . '/', $file, $request['name'] . '.' . $ext)) {
            
            if($request['name'] == 'inscripcion_de_socio'){
                $subidos = Subido::where('prestamos_id', $request['prestamo_id'])->first();
                $subidos->inscripcion_socio=1;
                $subidos->save();
            }            
            if($request['name'] == 'solicitud_credito'){
                $subidos = Subido::where('prestamos_id', $request['prestamo_id'])->first();
                $subidos->solicitud_credito=1;
                $subidos->save();
            }            
            if($request['name'] == 'reporte_de_central'){
                $subidos = Subido::where('prestamos_id', $request['prestamo_id'])->first();
                $subidos->reporte_de_central=1;
                $subidos->save();
            }            
            if($request['name'] == 'evaluacion_cualitativa'){
                $subidos = Subido::where('prestamos_id', $request['prestamo_id'])->first();
                $subidos->evaluacion_cualitativa=1;
                $subidos->save();
            }            
            if($request['name'] == 'evaluacion_cuantitativa'){
                $subidos = Subido::where('prestamos_id', $request['prestamo_id'])->first();
                $subidos->evaluacion_cuantitativa=1;
                $subidos->save();
            }            
            if($request['name'] == 'copia_dni'){
                $subidos = Subido::where('prestamos_id', $request['prestamo_id'])->first();
                $subidos->copia_dni=1;
                $subidos->save();
            }            
            if($request['name'] == 'recibo_agua_casa'){
                $subidos = Subido::where('prestamos_id', $request['prestamo_id'])->first();
                $subidos->recibo_agua_casa=1;
                $subidos->save();
            }            
            if($request['name'] == 'recibo_luz_casa'){
                $subidos = Subido::where('prestamos_id', $request['prestamo_id'])->first();
                $subidos->recibo_luz_casa=1;
                $subidos->save();
            }            
            
            
            return $model::create([
                    'nombre' => $request['name'],
                    'tipo' => $type,
                    'extension' => $ext,
                    'prestamos_id' => $request['prestamo_id']
                ]);
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
        $cliente = Cliente::where('id',$prestamo->clientes_id)->first();
        return $cliente->documento.'_' . $cliente->id;
    }
}

  