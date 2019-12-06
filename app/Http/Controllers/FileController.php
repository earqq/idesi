<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App;
use App\Archivo;
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
                            ->select('clientes.nombres','clientes.apellidos','clientes.id')
                            ->where('prestamos.id',$id)->first();

        $model = new Archivo();
        $files = $model::where('prestamos_id', $id)->get();
        return ['files'=>$files,'datos'=>$pretamos];

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
            return $model::create([
                    'nombre' => $request['name'],
                    'tipo' => $type,
                    'extension' => $ext,
                    'prestamos_id' => $request['prestamo_id']
                ]);
        }
 
        return response()->json(false);
    }




    /**
     * Delete file from disk and database
     * @param  integer $id  File Id
     * @return boolean      True if success, otherwise - false
     */
    public function destroy($id,$prestamo)
    {
        $file = Archivo::findOrFail($id);

        if (Storage::disk('local')->exists('/public/' . $this->getUserDir($prestamo) . '/' . $file->tipo . '/' . $file->nombre . '.' . $file->extension)) {
            if (Storage::disk('local')->delete('/public/' . $this->getUserDir($prestamo) . '/' . $file->tipo . '/' . $file->nombre . '.' . $file->extension)) {
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
        return $cliente->nombres.'_'. $cliente->apellidos .'_' . $cliente->id;
    }
}

