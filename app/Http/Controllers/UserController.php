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
        $evaluador_final = User::where('nivel','4')->count();
        $users=User::where('nivel','>',1)
        ->where('name','like', '%'. $buscar . '%')
        ->paginate(10);
        
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
        try{
            DB::beginTransaction();
            $user = new User();
            if($request->id!=0)
                $user=User::find($request->id);
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

    
    public function currentUser()
    {
        $user = Auth::user();
        return $user;
    }
}
