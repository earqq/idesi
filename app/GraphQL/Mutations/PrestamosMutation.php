<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL;
use App\Prestamo;
use App\Cualitativa;
use App\Conyuge;
use App\Trabajo;
use App\Cliente;
use App\Persona;
use Auth;
class PrestamosMutation extends Mutation
{
    protected $attributes = [
        'name' => 'prestamos',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('prestamo');
    }

    public function args(): array
    {
        return [
            'id'=>[
                'type'=>Type::int(),
                'description'=>'Invoice id'
            ],
            'user_id'=>[
                'type'=>Type::int(),
                'description'=>'User id'
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
            'cliente'=>[
                'type'=>GraphQL::type("clienteInput"),
                'description'=>'Cliente ah quien se hizo prestamo'
            ],       
            'cualitativa'=>[
                'type'=>GraphQL::type("cualitativaInput"),
                'description'=>'Eval cualitativa donde se hizo prestamo'
            ],            
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();        
        $prestamo = new prestamo;
        if(isset($args["id"]) && $args["id"]!='0')
            $prestamo=prestamo::find($args["id"]);
        if(isset($args["monto_cliente"]))
            $prestamo->monto_cliente=$args["monto_cliente"];
        if(isset($args["cuotas_cliente"]))
            $prestamo->cuotas_cliente=$args["cuotas_cliente"];
        if(isset($args["disponibilidad_pago"]))
            $prestamo->disponibilidad_pago=$args["disponibilidad_pago"];
        if(isset($args["forma"]))
            $prestamo->forma=$args["forma"];
        $prestamo->cliente_id=$args["cliente"]["id"];
        if(isset($args["user_id"]))
        $prestamo->user_id=$args["user_id"];
        $prestamo->save();

        if(isset($args["cualitativa"])){
            $cualitativa= new cualitativa;
            $cualitativa->prestamo_id=$prestamo->id;
            if(isset($args["id"]) && $args["id"]!='0')
                $cualitativa=$prestamo->cualitativa;
            if(isset($args["fuente_ingresos"]))
                $cualitativa->fuente_ingresos=$args["fuente_ingresos"];
            if(isset($args["destino_credito"]))
                $cualitativa->destino_credito=$args["destino_credito"];
            if(isset($args["destino_credito_descripcion"]))
                $cualitativa->destino_credito_descripcion=$args["destino_credito_descripcion"];
            $cualitativa->save();
        }

        if(isset($args["cliente"])){
            $cliente=$prestamo->cliente;
            if(isset($args["tipo_documento"]))
                $cliente->tipo_documento=$args["tipo_documento"];
            if(isset($args["documento"]))
                $cliente->documento=$args["documento"];
            if(isset($args["tipo_cliente"]))
                $cliente->tipo_cliente=$args["tipo_cliente"];
            if(isset($args["codigo"]))
                $cliente->codigo=$args["codigo"];
            if(isset($args["pais"]))
                $cliente->pais=$args["pais"];
            if(isset($args["ubicacion_departamento"]))
                $cliente->ubicacion_departamento=$args["ubicacion_departamento"];
            if(isset($args["ubicacion_provincia"]))
                $cliente->ubicacion_provincia=$args["ubicacion_provincia"];
            if(isset($args["ubicacion_distrito"]))
                $cliente->ubicacion_distrito=$args["ubicacion_distrito"];
            if(isset($args["estado"]))
                $cliente->estado=$args["estado"];
            if(isset($args["ubicacion_direccion_declarada"]))
                $cliente->ubicacion_direccion_declarada=$args["ubicacion_direccion_declarada"];
            if(isset($args["ubicacion_referencia"]))
                $cliente->ubicacion_referencia=$args["ubicacion_referencia"];
            if(isset($args["telefono"]))
                $cliente->telefono=$args["telefono"];
            if(isset($args["celular"]))
                $cliente->celular=$args["celular"];
            if(isset($args["email"]))
                $cliente->email=$args["email"];
            $cliente->save();
            if(isset($args["cliente"]["persona"])  && $args['cliente']['persona']["nombres"]!=''){
                $persona= new persona;
                if($cliente->persona)
                    $persona=$cliente->persona;
                if(isset($args["nombres"]))
                    $persona->nombres=$args["nombres"];
                if(isset($args["apellidos"]))
                    $persona->apellidos=$args["apellidos"];
                if(isset($args["fecha_nacimiento"]))
                    $persona->fecha_nacimiento=$args["fecha_nacimiento"];
                if(isset($args["estado_civil"]))
                    $persona->estado_civil=$args["estado_civil"];
                if(isset($args["ocupacion"]))
                    $persona->ocupacion=$args["ocupacion"];
                if(isset($args["tipo_domicilio"]))
                    $persona->tipo_domicilio=$args["tipo_domicilio"];
                if(isset($args["centro_laboral"]))
                    $persona->centro_laboral=$args["centro_laboral"];
                if(isset($args["direccion_laboral"]))
                    $persona->direccion_laboral=$args["direccion_laboral"];
                    $persona->save();
                if(isset($args["cliente"]["persona"]["trabajo"]) &&  $args["cliente"]["persona"]["trabajo"]["empresa_razon_social"]!=''){
                    $trabajo= new trabajo;
                    $trabajo->persona_id=$persona->id;;
                    if($persona->trabajo)
                        $trabajo=$persona->trabajo;
                    if(isset($args["empresa_ruc"]))
                        $trabajo->empresa_ruc=$args["empresa_ruc"];
                    if(isset($args["empresa_razon_social"]))
                        $trabajo->empresa_razon_social=$args["empresa_razon_social"];
                    if(isset($args["empresa_direccion"]))
                        $trabajo->empresa_direccion=$args["empresa_direccion"];
                    $trabajo->save();
                }
                if(isset($args["cliente"]["persona"]["conyuge"]) && $args["cliente"]["persona"]["conyuge"]["documento"]!=''){
                    $conyuge= new conyuge;
                    $conyuge->persona_id=$persona->id;;
                    if($persona->conyuge)
                        $conyuge=$persona->conyuge;
                    if(isset($args["documento"]))
                        $conyuge->documento=$args["documento"];
                    if(isset($args["nombres"]))
                        $conyuge->nombres=$args["nombres"];
                    if(isset($args["fecha_nacimiento"]))
                        $conyuge->fecha_nacimiento=$args["fecha_nacimiento"];
                    if(isset($args["estado_civil"]))
                        $conyuge->estado_civil=$args["estado_civil"];
                    if(isset($args["ocupacion"]))
                        $conyuge->ocupacion=$args["ocupacion"];
                    if(isset($args["telefono"]))
                        $conyuge->telefono=$args["telefono"];
                    if(isset($args["celular"]))
                        $conyuge->celular=$args["celular"];
                    if(isset($args["centro_laboral"]))
                        $conyuge->centro_laboral=$args["centro_laboral"];
                    if(isset($args["direccion_centro_laboral"]))
                        $conyuge->direccion_centro_laboral=$args["direccion_centro_laboral"];
                    if(isset($args["socio"]))
                        $conyuge->socio=$args["socio"];
                    if(isset($args["codigo_socio"]))
                        $conyuge->codigo_socio=$args["codigo_socio"];
                    if(isset($args["aporte_socio"]))
                        $conyuge->aporte_socio=$args["aporte_socio"];
                    if(isset($args["trabaja"]))
                        $conyuge->trabaja=$args["trabaja"];
                    $conyuge->save();
                }
                if(isset($args["nombres"]))
                    $persona->nombres=$args["nombres"];
            }
        }
        return $prestamo;;
    }
}
