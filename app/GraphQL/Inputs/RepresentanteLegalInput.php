<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;
use GraphQL;
class RepresentanteLegalInput extends InputType
{
    protected $attributes = [
        'name' => 'RepresentanteLegalInput',
        'description' => 'An example input',
    ];

    public function fields(): array
    {
        return [
            'nombres'=>[
                'type'=>Type::string(),
                'description'=>'nombres'
            ],
            'documento'=>[
                'type'=>Type::string(),
                'description'=>'documento'
            ],
            'cargo'=>[
                'type'=>Type::int(),
                'description'=>'cargo'
            ],
            'fecha_nacimiento'=>[
                'type'=>Type::string(),
                'description'=>'fecha_nacimiento empresa'
            ],
            'ocupacion'=>[
                'type'=>Type::string(),
                'description'=>'ocupacion empresa'
            ],
            'telefono'=>[
                'type'=>Type::string(),
                'description'=>'telefono empresa'
            ],
            'celular'=>[
                'type'=>Type::string(),
                'description'=>'celular empresa'
            ],
            'ubicacion_direccion'=>[
                'type'=>Type::string(),
                'description'=>'ubicacion_direccion empresa'
            ],
            'ubicacion_departamento'=>[
                'type'=>Type::string(),
                'description'=>'ubicacion_departamento empresa'
            ],
            'ubicacion_provincia'=>[
                'type'=>Type::string(),
                'description'=>'ubicacion_provincia empresa'
            ],
            'ubicacion_distrito'=>[
                'type'=>Type::string(),
                'description'=>'ubicacion_distrito empresa'
            ],
            'ubicacion_referencia'=>[
                'type'=>Type::string(),
                'description'=>'ubicacion_referencia empresa'
            ],
            'tipo_domicilio'=>[
                'type'=>Type::string(),
                'description'=>'tipo_domicilio empresa'
            ],      
            'poderes'=>[
                'type'=>Type::string(),
                'description'=>'poderes empresa'
            ],
            'fecha_inicio'=>[
                'type'=>Type::string(),
                'description'=>'fecha_inicio empresa'
            ],
            'estado_civil'=>[
                'type'=>Type::string(),
                'description'=>'estado_civil empresa'
            ],
        ];
    }
}
