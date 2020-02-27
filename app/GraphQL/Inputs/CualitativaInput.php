<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class CualitativaInput extends InputType
{
    protected $attributes = [
        'name' => 'CualitativaInput',
        'description' => 'An example input',
    ];

    public function fields(): array
    {
        return [
            'id'=>[
                'type'=>Type::int(),
                'description'=>'Invoice id'
            ],
            'fuente_ingresos'=>[
                'type'=>Type::string(),
                'description'=>'fuente ingresos'
            ],
            'destino_credito'=>[
                'type'=>Type::string(),
                'description'=>'destino credito'
            ],
            'ubicacion_negocio'=>[
                'type'=>Type::string(),
                'description'=>'ubicacion negocio'
            ],      
            'antiguedad'=>[
                'type'=>Type::int(),
                'description'=>'antiguedad'
            ],      
            'local'=>[
                'type'=>Type::string(),
                'description'=>'local'
            ],      
            'licencia_funcionamiento'=>[
                'type'=>Type::string(),
                'description'=>'licencia funcionamiento'
            ],      
            'mejoras_local'=>[
                'type'=>Type::boolean(),
                'description'=>'Mejoras local'
            ],      
            'horario_atencion_entrada'=>[
                'type'=>Type::string(),
                'description'=>'horario entrada local'
            ],      
            'horario_atencion_salida'=>[
                'type'=>Type::string(),
                'description'=>'horario salida local'
            ],      
            'colateral'=>[
                'type'=>Type::string(),
                'description'=>'colateral'
            ],      
            'descripcion_colateral'=>[
                'type'=>Type::string(),
                'description'=>'descripcion_colateral'
            ], 
            'destino_credito_descripcion'=>[
                'type'=>Type::string(),
                'description'=>'destino credito descripcion'
            ],      
        ];
    }
}
