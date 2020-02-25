<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
class DepartamentoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Departamento',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id'=>[
                'type'=>Type::nonNull(Type::string()),
                'description'=>'departamento id'
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
