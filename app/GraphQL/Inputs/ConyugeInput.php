<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class ConyugeInput extends InputType
{
    protected $attributes = [
        'name' => 'ConyugeInput',
        'description' => 'An example input',
    ];

    public function fields(): array
    {
        return [
            'id'=>[
                'type'=>Type::string(),
                'description'=>'departamento id'
            ],
            'documento'=>[
                'type'=>Type::string(),
                'description'=>'bien documento'
            ],
            'nombres'=>[
                'type'=>Type::string(),
                'description'=>'nombres'
            ],
            'fecha_nacimiento'=>[
                'type'=>Type::string(),
                'description'=>'bien fecha_nacimiento'
            ],
            'estado_civil'=>[
                'type'=>Type::string(),
                'description'=>'estado_civil'
            ],
            'ocupacion'=>[
                'type'=>Type::string(),
                'description'=>'bien ocupacion'
            ],
            'telefono'=>[
                'type'=>Type::string(),
                'description'=>'telefono'
            ],
            'celular'=>[
                'type'=>Type::string(),
                'description'=>'bien celular'
            ],
            'centro_laboral'=>[
                'type'=>Type::string(),
                'description'=>'centro_laboral'
            ],
            'direccion_centro_laboral'=>[
                'type'=>Type::string(),
                'description'=>'direccion_centro_laboral'
            ],
            'socio'=>[
                'type'=>Type::boolean(),
                'description'=>'socio'
            ],
            'codigo_socio'=>[
                'type'=>Type::string(),
                'description'=>'codigo socio'
            ],
            'aporte_socio'=>[
                'type'=>Type::string(),
                'description'=>'aporte socio'
            ],
            'trabaja'=>[
                'type'=>Type::boolean(),
                'description'=>'trabaja'
            ],
           
        ];
    }
}
