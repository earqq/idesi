<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use GraphQL;
class PrestamoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Prestamo type'        
    ];

    public function fields(): array
    {
        return [
            'id'=>[
                'type'=>Type::nonNull(Type::int()),
                'description'=>'Invoice id'
            ],
            'monto_cliente'=>[
                'type'=>Type::float(),
                'description'=>'Monto cliente'
            ],
            'cuotas_cliente'=>[
                'type'=>Type::int(),
                'description'=>'Cuotas cliente'
            ],
            'disponibilidad_pago'=>[
                'type'=>Type::float(),
                'description'=>'Disponibilidad pago '
            ],
            'forma'=>[
                'type'=>Type::string(),
                'description'=>'Forma '
            ],
            'producto_analista'=>[
                'type'=>Type::string(),
                'description'=>'Producto'
            ],
            'importe_analista'=>[
                'type'=>Type::float(),
                'description'=>'importe prestamo por analista'
            ],
            'meses_analista'=>[
                'type'=>Type::float(),
                'description'=>'meses'
            ],
            'aporte_analista'=>[
                'type'=>Type::float(),
                'description'=>'Aporte segun analista'
            ],
            'cuota_sistema'=>[
                'type'=>Type::float(),
                'description'=>'cuota sistema'
            ],
            'cuotas_analista'=>[
                'type'=>Type::int(),
                'description'=>'cuotas segun analista'
            ],
            'comentarios'=>[
                'type'=>Type::string(),
                'description'=>'comentarios prestamos'
            ],
            'producto_final'=>[
                'type'=>Type::string(),
                'description'=>'Producto final'
            ],
            'aporte_final'=>[
                'type'=>Type::float(),
                'description'=>'Aporte final'
            ],
            'importe_final'=>[
                'type'=>Type::float(),
                'description'=>'Importe final'
            ],
            'cuotas_final'=>[
                'type'=>Type::int(),
                'description'=>'Cuotas final'
            ],
            'cuantitativa'=>[
                'type'=>Type::boolean(),
                'description'=>'Eval cuantitativa'
            ],
            'cualitativa'=>[
                'type'=>Type::boolean(),
                'description'=>'Eval cualitativa'
            ],
            'estado'=>[
                'type'=>Type::int(),
                'description'=>'Estado prestamo'
            ],
            'probabilidad_infocorp'=>[
                'type'=>Type::int(),
                'description'=>'Probabilidad infocorp'
            ],
            'longitud'=>[
                'type'=>Type::string(),
                'description'=>'Longitud'
            ],
            'latitud'=>[
                'type'=>Type::string(),
                'description'=>'Latitud'
            ],
            'cualitativa'=>[
                'type'=>Type::boolean(),
                'description'=>'cualitativa'
            ],
            'cuantitativa'=>[
                'type'=>Type::boolean(),
                'description'=>'cuantitativa'
            ],
            'cliente'=>[
                'type'=>GraphQL::type("cliente"),
                'description'=>'Cliente ah quien se hizo prestamo'
            ],
            'user'=>[
                'type'=>GraphQL::type("user"),
                'description'=>'Cliente ah quien se hizo prestamo'
            ],
            'cualitativaAnalisis'=>[
                'type'=>GraphQL::type("cualitativa"),
                'description'=>'Cliente ah quien se hizo prestamo'
            ],
            'resultado_analisis'=>[
                'type'=>GraphQL::type("resultadoAnalisis"),
                'description'=>'Cliente ah quien se hizo prestamo'
            ],
            'garantias'=>[
                'type'=>Type::listOf(GraphQL::type("garantia")),
                'description'=>'Garantias de prestamo'
            ],
            'archivos'=>[
                'type'=>Type::listOf(GraphQL::type("archivo")),
                'description'=>'Archivos de prestamo'
            ],
            'avales'=>[
                'type'=>Type::listOf(GraphQL::type("aval")),
                'description'=>'Avales de prestamo'
            ],
            'evaluaciones'=>[
                'type'=>Type::listOf(GraphQL::type("evaluacion")),
                'description'=>'Evaluaciones de prestamo'
            ],                       
        ];
    }
}
