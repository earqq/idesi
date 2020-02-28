<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use GraphQL;
class EmpresaType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Empresa Type'        
    ];

    public function fields(): array
    {
        return [
            'id'=>[
                'type'=>Type::int(),
                'description'=>'Invoice id'
            ],
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
                'type'=>GraphQL::type("representante"),
                'description'=>'representante de cliente'
            ],       
        ];
    }
}
