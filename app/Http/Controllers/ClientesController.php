<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Prestamo;
use App\Departamento;
use App\Distrito;
use App\Aval;
use App\Archivo;
use App\Garantia;
use App\Provincia;
use App\Conyuge;
use App\Persona;
use App\Representante;
use App\Trabajo;
use App\Juridico;
use App\Subido;
use App\Vista;
use App\Hijo;
use App\RepresentanteLegal;
use App\ResultadoCuantitativa;
use App\Obligacion;
use App\Asociativa;
use App\Evaluacion;
use App\Empresa;
use App\Declaracion;
use App\DeclaracionJuridico;
use App\Director;
use App\Accionista;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class ClientesController extends Controller
{

    public function listar($estado,$text=''){  
        $clientes=Cliente::with('persona','empresa')      
        ->where(function($query) use($estado){
            if($estado!='4'){
                $query->where('estado',$estado);
            }
        })
        ->where(function($query) use($text){
            if($text!=''){
                $text=strtoupper($text);
                $query->orWhere('persona.nombres', 'LIKE', "%{$text}%")
                ->orWhere('documento', 'LIKE', "%{$text}%")
                ->orWhere('persona.apellidos', 'LIKE', "%{$text}%")
                ->orWhere('empresa.razon_social', 'LIKE', "%{$text}%");
            }
        })
        ->where(function($query){
            if(Auth::user()->nivel == '4')
                $query->where('user_id','=', Auth::user()->id);  
        })
        ->orderBy('id','desc')       
        ->take(30)
        ->get();    
        return $clientes;
    }


    public function show($id)
    {
        $cliente=Cliente::with('persona.trabajo','persona.conyuge','empresa.representante','prestamos')
        ->find($id);
        return $cliente;        
    }


    public function aceptarSolicitud($id)
    {
        try{

            DB::beginTransaction();
            $cliente = Cliente::find($id);
            $cliente->estado = 2;
            $cliente->save();

            DB::commit();

            return [
                'success' => true
            ];

        } catch (Exception $e){
            return [
                'success' => false,
            ];
            DB::rollBack();
        }
    }

    public function rechazarSolicitud($id)
    {

        try{

            DB::beginTransaction();

            $cliente = Cliente::find($id);
            $cliente->estado = 3;
            $cliente->save();
            DB::commit();
            return [
                'success' => true
            ];

        } catch (Exception $e){
            return [
                'success' => false,
            ];
            DB::rollBack();
        }
    }


    
  

  

    public function visitaStore(Request $request)
    {
 
        
    }   
    private function getUserDir($id)
    {   
        $prestamo = Prestamo::where('id',$id)->first();
        $cliente = Cliente::where('id',$prestamo->clientes_id)->first();
        return $cliente->nombres.'_'. $cliente->apellidos .'_' . $cliente->id;
    }
    
}
