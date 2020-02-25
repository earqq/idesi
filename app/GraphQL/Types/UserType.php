<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Usuario Type'        
    ];

    public function fields(): array
    {
        return [
            'id'=>[
                'type'=>Type::nonNull(Type::int()),
                'description'=>'Invoice id'
            ],
            'name'=>[
                'type'=>Type::string(),
                'description'=>'Nombre'
            ],
            'usuario'=>[
                'type'=>Type::string(),
                'description'=>'Usuario'
            ],
            'password'=>[
                'type'=>Type::string(),
                'description'=>'password'
            ],
            'nivel'=>[
                'type'=>Type::int(),
                'description'=>'Nivel usuario '
            ],        
        ];
    }
}
