<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
class RolController extends Controller
{
    public function selectRol(Request $request)
    {
        $roles = Role::where('condicion', '=', '1')
        ->select('id','nombre')
        ->orderBy('nombre', 'asc')->get();

        return ['roles' => $roles];
    } 

    public function rolUser(Request $request)
    {

        $rol = User::where('id', Auth::user()->id)->select('idrol')->first();
        return $rol;
    }

}
