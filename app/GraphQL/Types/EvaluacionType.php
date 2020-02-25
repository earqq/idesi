<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use GraphQL;
class EvaluacionType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Evaluacion Type'        
    ];

    public function fields(): array
    {
        return [
            'id'=>[
                'type'=>Type::nonNull(Type::int()),
                'description'=>'Invoice id'
            ],
            'detalle'=>[
                'type'=>Type::string(),
                'description'=>'detalle'
            ],
            'estado'=>[
                'type'=>Type::int(),
                'description'=>'estado evaluacion'
            ],
            'user'=>[
                'type'=>GraphQL::type("user"),
                'description'=>'Cliente ah quien se hizo prestamo'
            ],      
        ];
    }
}
