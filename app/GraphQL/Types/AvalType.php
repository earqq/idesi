<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
class AvalType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Aval Type'        
    ];

    public function fields(): array
    {
        return [
            'id'=>[
                'type'=>Type::nonNull(Type::int()),
                'description'=>'Invoice id'
            ],
            'documento'=>[
                'type'=>Type::string(),
                'description'=>'documento'
            ],
            'tipo_persona'=>[
                'type'=>Type::string(),
                'description'=>'tipo persona'
            ],
            'nombres'=>[
                'type'=>Type::string(),
                'description'=>'nombres persona'
            ],
            'apellidos'=>[
                'type'=>Type::string(),
                'description'=>'apellidos persona'
            ],
            'fecha_nacimiento'=>[
                'type'=>Type::string(),
                'description'=>'fecha nacimiento persona'
            ],
            'estado_civil'=>[
                'type'=>Type::string(),
                'description'=>'estado civil'
            ],
            'ocupacion'=>[
                'type'=>Type::string(),
                'description'=>'ocupacion'
            ],
            'telefono'=>[
                'type'=>Type::string(),
                'description'=>'telefono'
            ],
            'celular'=>[
                'type'=>Type::string(),
                'description'=>'celular'
            ],
            'direccion'=>[
                'type'=>Type::string(),
                'description'=>'direccion'
            ],
            'distrito'=>[
                'type'=>Type::string(),
                'description'=>'distrito'
            ],
            'centro_laboral'=>[
                'type'=>Type::string(),
                'description'=>'centro laboral'
            ],
            'direccion_centro_laboral'=>[
                'type'=>Type::string(),
                'description'=>'direccion_centro_laboral'
            ],
            'socio'=>[
                'type'=>Type::boolean(),
                'description'=>'socio'
            ],
            'codigo_socio'=>[
                'type'=>Type::string(),
                'description'=>'codigo_socio'
            ],
            'aporte_socio'=>[
                'type'=>Type::float(),
                'description'=>'aporte_socio'
            ],
            'empresa_ruc'=>[
                'type'=>Type::string(),
                'description'=>'empresa_ruc'
            ],
            'empresa_razon_social'=>[
                'type'=>Type::string(),
                'description'=>'empresa_razon_social'
            ],
            'empresa_direccion'=>[
                'type'=>Type::string(),
                'description'=>'empresa_direccion'
            ],


        ];
    }
}
