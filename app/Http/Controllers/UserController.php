<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $personas = User::join('roles','users.idrol','=','roles.id')
            ->select('users.id','users.name','users.tipo_documento','users.num_documento','users.direccion','users.telefono'
                     ,'users.email','users.usuario','users.password','users.condicion','users.idrol','roles.nombre as rol')
            ->orderBy('users.id', 'desc')->paginate(3);
        }
        else{
            $personas = User::join('roles','users.idrol','=','roles.id')
            ->select('users.id','users.name','users.tipo_documento','users.num_documento','users.direccion','users.telefono'
                     ,'users.email','users.usuario','users.password','users.condicion','users.idrol','roles.nombre as rol')
            ->where('users.'.$criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }
        
        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }

    public function tipo()
    {
        $user = User::find(Auth::user()->id);
        return $user;
    }
    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $user = new User();
            $user->idrol = $request->idrol;          
            $user->name = $request->name;
            $user->tipo_documento = $request->tipo_documento;
            $user->num_documento = $request->num_documento;
            $user->direccion = $request->direccion;
            $user->telefono = $request->telefono;
            $user->email = $request->email;
            $user->usuario = $request->usuario;
            $user->password = bcrypt( $request->password);
            $user->condicion = '1';
            $user->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $user = User::findOrFail($request->id);

            $user->name = $request->name;
            $user->tipo_documento = $request->tipo_documento;
            $user->num_documento = $request->num_documento;
            $user->direccion = $request->direccion;
            $user->telefono = $request->telefono;
            $user->email = $request->email;
            $user->usuario = $request->usuario;
            $user->password = bcrypt( $request->password);
            $user->condicion = '1';
            $user->idrol = $request->idrol;
            $user->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }
}
