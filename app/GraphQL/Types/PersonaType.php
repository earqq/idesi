<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use GraphQL;
class PersonaType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Persona',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id'=>[
                'type'=>Type::nonNull(Type::int()),
                'description'=>'Persona id'
            ],
            'nombres'=>[
                'type'=>Type::string(),
                'description'=>'nombres'
            ],
            'apellidos'=>[
                'type'=>Type::string(),
                'description'=>'apellidos'
            ],
            'fecha_nacimiento'=>[
                'type'=>Type::string(),
                'description'=>'fecha nacimiento'
            ],           
            'estado_civil'=>[
                'type'=>Type::string(),
                'description'=>'estado civil'
            ],           
            'ocupacion'=>[
                'type'=>Type::string(),
                'description'=>'ocupacion'
            ],           
            'tipo_domicilio'=>[
                'type'=>Type::string(),
                'description'=>'tipo domicilio'
            ],           
            'centro_laboral'=>[
                'type'=>Type::string(),
                'description'=>'centro laboral'
            ],
            'direccion_laboral'=>[
                'type'=>Type::string(),
                'description'=>'direccion laboral'
            ],
            'genero'=>[
                'type'=>Type::string(),
                'description'=>'genero'
            ],
            'grado_instruccion'=>[
                'type'=>Type::string(),
                'description'=>'grado instruccion'
            ],
            'estado_trabajo'=>[
                'type'=>Type::string(),
                'description'=>'estado trabajo'
            ],
            'trabajo_especificacion'=>[
                'type'=>Type::string(),
                'description'=>'trabajo especificacion'
            ],
            'nacimiento_departamento'=>[
                'type'=>Type::string(),
                'description'=>'nacimiento departamento'
            ],
            'nacimiento_provincia'=>[
                'type'=>Type::string(),
                'description'=>'nacimiento provincia'
            ],
            'nacimiento_distrito'=>[
                'type'=>Type::string(),
                'description'=>'nacimiento distrito'
            ],
            'trabajo'=>[
                'type'=>GraphQL::type("trabajo"),
                'description'=>'trabajo de cliente'
            ],
        ];
    }
}
