<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class TrabajoInput extends InputType
{
    protected $attributes = [
        'name' => 'TrabajoInput',
        'description' => 'An example input',
    ];

    public function fields(): array
    {
        return [
            'id'=>[
                'type'=>Type::int(),
                'description'=>'Invoice id'
            ],
            'estado_laboral'=>[
                'type'=>Type::string(),
                'description'=>'estado laboral'
            ],
            'tipo_trabajador'=>[
                'type'=>Type::string(),
                'description'=>'tipo trabajador'
            ],
            'especificacion'=>[
                'type'=>Type::string(),
                'description'=>'especificacion'
            ],
            'empresa_ruc'=>[
                'type'=>Type::string(),
                'description'=>'empresa ruc'
            ],    
            'empresa_razon_social'=>[
                'type'=>Type::string(),
                'description'=>'empresa_razon_social'
            ],  
            'ingreso_mensual'=>[
                'type'=>Type::string(),
                'description'=>'ingreso_mensual'
            ],  
            'cargo_ocupacion'=>[
                'type'=>Type::string(),
                'description'=>'cargo_ocupacion'
            ],           
            'fecha_ingreso'=>[
                'type'=>Type::string(),
                'description'=>'fecha_ingreso'
            ],  
            'empresa_giro_negocio'=>[
                'type'=>Type::string(),
                'description'=>'empresa_giro_negocio'
            ],  
            'empresa_direccion'=>[
                'type'=>Type::string(),
                'description'=>'empresa_direccion'
            ],  
            'empresa_distrito'=>[
                'type'=>Type::string(),
                'description'=>'empresa_distrito'
            ],  
            'empresa_provincia'=>[
                'type'=>Type::string(),
                'description'=>'empresa_provincia'
            ],  
            'empresa_departamento'=>[
                'type'=>Type::string(),
                'description'=>'empresa_departamento'
            ],  
            'empresa_pais'=>[
                'type'=>Type::string(),
                'description'=>'empresa_pais'
            ],  
            'empresa_referencia'=>[
                'type'=>Type::string(),
                'description'=>'empresa_referencia'
            ],  
            'empresa_telefono'=>[
                'type'=>Type::string(),
                'description'=>'empresa_telefono'
            ],  
            'empresa_celular'=>[
                'type'=>Type::string(),
                'description'=>'empresa_celular'
            ],  
            'empresa_email'=>[
                'type'=>Type::string(),
                'description'=>'empresa_email'
            ],           
        ];
    }
}
