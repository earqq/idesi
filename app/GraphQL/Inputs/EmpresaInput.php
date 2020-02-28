<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;
use GraphQL;
class EmpresaInput extends InputType
{
    protected $attributes = [
        'name' => 'EmpresaInput',
        'description' => 'An example input',
    ];

    public function fields(): array
    {
        return [
            'razon_social'=>[
                'type'=>Type::string(),
                'description'=>'razon_social'
            ],
            'nombre_comercial'=>[
                'type'=>Type::string(),
                'description'=>'nombre_comercial'
            ],
            'actividad_principal'=>[
                'type'=>Type::string(),
                'description'=>'actividad_principal'
            ],
            'partida_registral'=>[
                'type'=>Type::int(),
                'description'=>'partida_registral'
            ],
            'oficina_principal'=>[
                'type'=>Type::string(),
                'description'=>'oficina_principal persona'
            ],
            'tipo_negocio'=>[
                'type'=>Type::string(),
                'description'=>'tipo_negocio persona'
            ],
            'fecha_constitucion'=>[
                'type'=>Type::string(),
                'description'=>'fecha_constitucion persona'
            ],        
            'representante'=>[
                'type'=>GraphQL::type("representanteInput"),
                'description'=>'representante de cliente'
            ],
        ];
    }
}
