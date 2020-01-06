<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RolController extends Controller
{
    public function selectRol(Request $request)
    {
        $roles = Role::where('condicion', '=', '1')
        ->select('id','nombre')
        ->orderBy('nombre', 'asc')->get();

        return ['roles' => $roles];
    } 
}
