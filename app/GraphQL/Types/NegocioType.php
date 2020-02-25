<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
class NegocioType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Negocio',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id'=>[
                'type'=>Type::nonNull(Type::int()),
                'description'=>'Invoice id'
            ],
            'giro_negocio'=>[
                'type'=>Type::string(),
                'description'=>'giro negocio'
            ],
            'margen_maximo'=>[
                'type'=>Type::float(),
                'description'=>'margen maximo'
            ],
            'costo_ventas'=>[
                'type'=>Type::float(),
                'description'=>'costo de venta'
            ],           
        ];
    }
}
