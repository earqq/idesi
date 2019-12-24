<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departamento;
use App\Distrito;
use App\Provincia;

class UbigeoController extends Controller
{
   
    public function tables()
    {
        $departments = Departmento::whereActive()->orderByDescription()->get();
        $provinces = Provincia::whereActive()->orderByDescription()->get();
        $districts = Distrito::whereActive()->orderByDescription()->get();
        $locations = $this->getLocationCascade();
 
        return compact('departments', 'provinces', 'districts',  'locations');
    }

    public function getLocationCascade()
    {
        $locations = [];
        $departments = Departmento::where('activo', true)->get();
        foreach ($departments as $department)
        {
            $children_provinces = [];
            foreach ($department->provinces as $province)
            {
                $children_districts = [];
                foreach ($province->districts as $district)
                {
                    $children_districts[] = [
                        'value' => $district->id,
                        'label' => $district->descripcion
                    ];
                }
                $children_provinces[] = [
                    'value' => $province->id,
                    'label' => $province->descripcion,
                    'children' => $children_districts
                ];
            }
            $locations[] = [
                'value' => $department->id,
                'label' => $department->descripcion,
                'children' => $children_provinces
            ];
        }

        return $locations;
    }


}
