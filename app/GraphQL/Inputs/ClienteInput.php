<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;
use GraphQL;
class ClienteInput extends InputType
{
    protected $attributes = [
        'name' => 'ClienteInput',
        'description' => 'An example input',
    ];

    public function fields(): array
    {
        return [
            'id'=>[
                'type'=>Type::int(),
                'description'=>'Invoice id'
            ],
            'tipo_documento'=>[
                'type'=>Type::string(),
                'description'=>'tipo_documento'
            ],
            'documento'=>[
                'type'=>Type::string(),
                'description'=>'documento'
            ],
            'tipo_cliente'=>[
                'type'=>Type::int(),
                'description'=>'tipo_cliente'
            ],
            'codigo'=>[
                'type'=>Type::string(),
                'description'=>'codigo'
            ],
            'pais'=>[
                'type'=>Type::string(),
                'description'=>'pais persona'
            ],
            'ubicacion_departamento'=>[
                'type'=>Type::string(),
                'description'=>'ubicacion_departamento persona'
            ],
            'ubicacion_provincia'=>[
                'type'=>Type::string(),
                'description'=>'ubicacion_provincia persona'
            ],
            'ubicacion_distrito'=>[
                'type'=>Type::string(),
                'description'=>'ubicacion_distrito persona'
            ],
            'estado'=>[
                'type'=>Type::int(),
                'description'=>'estado persona'
            ],
            'ubicacion_direccion_declarada'=>[
                'type'=>Type::string(),
                'description'=>'ubicacion_direccion_declarada persona'
            ],
            'ubicacion_referencia'=>[
                'type'=>Type::string(),
                'description'=>'ubicacion referencia persona'
            ],
            'ubicacion_direccion_sistema'=>[
                'type'=>Type::string(),
                'description'=>'ubicacion direccion sistema'
            ],          
            'telefono'=>[
                'type'=>Type::string(),
                'description'=>'telefono'
            ],
            'celular'=>[
                'type'=>Type::string(),
                'description'=>'celular'
            ],
            'email'=>[
                'type'=>Type::string(),
                'description'=>'email'
            ],  
            'persona'=>[
                'type'=>GraphQL::type("personaInput"),
                'description'=>'persona de cliente'
            ],   
             //Extras
            'tiene_conyuge'=>[
                'type'=>Type::string(),
                'description'=>'aporte socio'
            ],   
            'validate'=>[
                'type'=>Type::boolean(),
                'description'=>'aporte socio'
            ],      
            'empresa'=>[
                'type'=>GraphQL::type("empresaInput"),
                'description'=>'empresa de cliente'
            ],
        ];
    }
}
