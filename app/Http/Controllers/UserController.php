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
    public function login(){
        $user = auth::user();
        return view('index');
    }
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $evaluador_final = 0;
        $evaluador = User::where('nivel','4')->first();
        $users=User::where('nivel','>',1)
        ->where('name','like', '%'. $buscar . '%')
        ->paginate(10);
        if($evaluador){
            $evaluador_final = 1;
        }
        
        return [          
            'users' => $users,
            'evaluador_final' => $evaluador_final
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
        \Log::alert($request->all());
        try{
            DB::beginTransaction();
            $user = new User();
            $user->nivel = $request->nivel;          
            $user->name = $request->name;
            $user->usuario = $request->usuario;
            $user->password = bcrypt( $request->password);
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
            $user->nivel = $request->nivel;
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

    
    public function currentUser()
    {
        $user = Auth::user();
        return $user;
    }
}
