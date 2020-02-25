<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
class GarantiaType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Garantia Type'        
    ];

    public function fields(): array
    {
        return [
            'id'=>[
                'type'=>Type::nonNull(Type::int()),
                'description'=>'Invoice id'
            ],
            'bien_garantia'=>[
                'type'=>Type::string(),
                'description'=>'bien garantia'
            ],
            'inscripcion'=>[
                'type'=>Type::boolean(),
                'description'=>'inscripcion'
            ],
            'declaracion_jurada'=>[
                'type'=>Type::boolean(),
                'description'=>'declaracion jurada'
            ],           
        ];
    }
}
