<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
class ArchivoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Archivo Type',
    ];

    public function fields(): array
    {
        return [
            'id'=>[
                'type'=>Type::nonNull(Type::int()),
                'description'=>'Invoice id'
            ],
            'nombre'=>[
                'type'=>Type::string(),
                'description'=>'nombre archivo'
            ],
            'tipo'=>[
                'type'=>Type::string(),
                'description'=>'tipo'
            ],
            'extension'=>[
                'type'=>Type::string(),
                'description'=>'extension'
            ],           
        ];
    }
}
