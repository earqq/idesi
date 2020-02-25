<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
class DistritoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Distrito',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id'=>[
                'type'=>Type::nonNull(Type::string()),
                'description'=>' id'
            ],
            'provincia_id'=>[
                'type'=>Type::int(),
                'description'=>'provincia id'
            ],
            'descripcion'=>[
                'type'=>Type::string(),
                'description'=>'bien garantia'
            ],
            'activo'=>[
                'type'=>Type::boolean(),
                'description'=>'inscripcion'
            ],
        ];
    }
}
