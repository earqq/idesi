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
use App\Empresa;
use App\RepresentanteLegal;
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
        if(isset($args["estado"]))
            $prestamo->estado=$args["estado"];
        $prestamo->cliente_id=$args["cliente"]["id"];
        if(isset($args["user_id"]))
        $prestamo->user_id=$args["user_id"];
        $prestamo->save();
        if(isset($args["cualitativa"])){
            $cualitativa= new cualitativa;
            $cualitativa->prestamo_id=$prestamo->id;
            
            if(isset($args["id"]) && $args["id"]!='0')
                $cualitativa=$prestamo->cualitativa;
            if(isset($args["cualitativa"]["fuente_ingresos"]))
                $cualitativa->fuente_ingresos=$args["cualitativa"]["fuente_ingresos"];
            if(isset($args["cualitativa"]["destino_credito"]))
                $cualitativa->destino_credito=$args["cualitativa"]["destino_credito"];
            if(isset($args["cualitativa"]["destino_credito_descripcion"]))
                $cualitativa->destino_credito_descripcion=$args["cualitativa"]["destino_credito_descripcion"];
            $cualitativa->save();
        }        
        if(isset($args["cliente"])){
            $cliente=$prestamo->cliente;
            if(isset($args["cliente"]["tipo_documento"]))
                $cliente->tipo_documento=$args["cliente"]["tipo_documento"];
            if(isset($args["cliente"]["documento"]))
                $cliente->documento=$args["cliente"]["documento"];
            if(isset($args["cliente"]["tipo_cliente"]))
                $cliente->tipo_cliente=$args["cliente"]["tipo_cliente"];
            if(isset($args["cliente"]["codigo"]))
                $cliente->codigo=$args["cliente"]["codigo"];
            if(isset($args["cliente"]["pais"]))
                $cliente->pais=$args["cliente"]["pais"];
            if(isset($args["cliente"]["ubicacion_departamento"]))
                $cliente->ubicacion_departamento=$args["cliente"]["ubicacion_departamento"];
            if(isset($args["cliente"]["ubicacion_provincia"]))
                $cliente->ubicacion_provincia=$args["cliente"]["ubicacion_provincia"];
            if(isset($args["cliente"]["ubicacion_distrito"]))
                $cliente->ubicacion_distrito=$args["cliente"]["ubicacion_distrito"];
            if(isset($args["cliente"]["estado"]))
                $cliente->estado=$args["cliente"]["estado"];
            if(isset($args["cliente"]["ubicacion_direccion_declarada"]))
                $cliente->ubicacion_direccion_declarada=$args["cliente"]["ubicacion_direccion_declarada"];
            if(isset($args["cliente"]["ubicacion_referencia"]))
                $cliente->ubicacion_referencia=$args["cliente"]["ubicacion_referencia"];
            if(isset($args["cliente"]["telefono"]))
                $cliente->telefono=$args["cliente"]["telefono"];
            if(isset($args["cliente"]["celular"]))
                $cliente->celular=$args["cliente"]["celular"];
            if(isset($args["cliente"]["email"]))
                $cliente->email=$args["cliente"]["email"];
            $cliente->save();
            if(isset($args["cliente"]["empresa"]) && $args["cliente"]["empresa"]["razon_social"]!=""){
                $empresa = new empresa;
                if($cliente->empresa)
                    $empresa=$cliente->empresa;
                $empresa->razon_social=$args["cliente"]["empresa"]["razon_social"];
                $empresa->nombre_comercial=$args["cliente"]["empresa"]["nombre_comercial"];
                $empresa->actividad_principal=$args["cliente"]["empresa"]["actividad_principal"];
                $empresa->partida_registral=$args["cliente"]["empresa"]["partida_registral"];
                $empresa->oficina_principal=$args["cliente"]["empresa"]["oficina_principal"];
                $empresa->tipo_negocio=$args["cliente"]["empresa"]["tipo_negocio"];
                $empresa->fecha_constitucion=$args["cliente"]["empresa"]["fecha_constitucion"];
                $empresa->save();
                if(isset($args["cliente"]["empresa"]["representante"]) && $args["cliente"]["empresa"]["representante"]["nombres"]!=''){
                    $representante= new RepresentanteLegal;
                    if($empresa->representante)
                        $representante=$empresa->representante;
                    if(isset($args["cliente"]["empresa"]["representante"]["nombres"]))
                    $representante->nombres=$args["cliente"]["empresa"]["representante"]["nombres"];
                    if(isset($args["cliente"]["empresa"]["representante"]["cargo"]))
                    $representante->cargo=$args["cliente"]["empresa"]["representante"]["cargo"];
                    if(isset($args["cliente"]["empresa"]["representante"]["fecha_nacimiento"]))
                    $representante->fecha_nacimiento=$args["cliente"]["empresa"]["representante"]["fecha_nacimiento"];
                    if(isset($args["cliente"]["empresa"]["representante"]["ocupacion"]))
                    $representante->ocupacion=$args["cliente"]["empresa"]["representante"]["ocupacion"];
                    if(isset($args["cliente"]["empresa"]["representante"]["telefono"]))
                    $representante->telefono=$args["cliente"]["empresa"]["representante"]["telefono"];
                    if(isset($args["cliente"]["empresa"]["representante"]["celular"]))
                    $representante->celular=$args["cliente"]["empresa"]["representante"]["celular"];
                    if(isset($args["cliente"]["empresa"]["representante"]["ubicacion_direccion"]))
                    $representante->ubicacion_direccion=$args["cliente"]["empresa"]["representante"]["ubicacion_direccion"];
                    if(isset($args["cliente"]["empresa"]["representante"]["ubicacion_departamento"]))
                    $representante->ubicacion_departamento=$args["cliente"]["empresa"]["representante"]["ubicacion_departamento"];
                    if(isset($args["cliente"]["empresa"]["representante"]["ubicacion_provincia"]))
                    $representante->ubicacion_provincia=$args["cliente"]["empresa"]["representante"]["ubicacion_provincia"];
                    if(isset($args["cliente"]["empresa"]["representante"]["ubicacion_distrito"]))
                    $representante->ubicacion_distrito=$args["cliente"]["empresa"]["representante"]["ubicacion_distrito"];
                    if(isset($args["cliente"]["empresa"]["representante"]["ubicacion_referencia"]))
                    $representante->ubicacion_referencia=$args["cliente"]["empresa"]["representante"]["ubicacion_referencia"];
                    if(isset($args["cliente"]["empresa"]["representante"]["tipo_domicilio"]))
                    $representante->tipo_domicilio=$args["cliente"]["empresa"]["representante"]["tipo_domicilio"];
                    if(isset($args["cliente"]["empresa"]["representante"]["poderes"]))
                    $representante->poderes=$args["cliente"]["empresa"]["representante"]["poderes"];
                    if(isset($args["cliente"]["empresa"]["representante"]["fecha_inicio"]))
                    $representante->fecha_inicio=$args["cliente"]["empresa"]["representante"]["fecha_inicio"];
                    if(isset($args["cliente"]["empresa"]["representante"]["estado_civil"]))
                    $representante->estado_civil=$args["cliente"]["empresa"]["representante"]["estado_civil"];
                    $representante->save();
                }
                $empresa->tipo_negocio=$args["cliente"]["empresa"]["tipo_negocio"];
            }
            // $aca
            if(isset($args["cliente"]["persona"])  && $args['cliente']['persona']["nombres"]!=''){
                $persona= new persona;
                if($cliente->persona)
                    $persona=$cliente->persona;
                if(isset($args["cliente"]["persona"]["nombres"]))
                    $persona->nombres=$args["cliente"]["persona"]["nombres"];
                if(isset($args["cliente"]["persona"]["apellidos"]))
                    $persona->apellidos=$args["cliente"]["persona"]["apellidos"];
                if(isset($args["cliente"]["persona"]["fecha_nacimiento"]))
                    $persona->fecha_nacimiento=$args["cliente"]["persona"]["fecha_nacimiento"];
                if(isset($args["cliente"]["persona"]["estado_civil"]))
                    $persona->estado_civil=$args["cliente"]["persona"]["estado_civil"];
                if(isset($args["cliente"]["persona"]["ocupacion"]))
                    $persona->ocupacion=$args["cliente"]["persona"]["ocupacion"];
                if(isset($args["cliente"]["persona"]["tipo_domicilio"]))
                    $persona->tipo_domicilio=$args["cliente"]["persona"]["tipo_domicilio"];
                if(isset($args["cliente"]["persona"]["centro_laboral"]))
                    $persona->centro_laboral=$args["cliente"]["persona"]["centro_laboral"];
                if(isset($args["cliente"]["persona"]["direccion_laboral"]))
                    $persona->direccion_laboral=$args["cliente"]["persona"]["direccion_laboral"];
                    $persona->save();
                if(isset($args["cliente"]["persona"]["trabajo"]) &&  $args["cliente"]["persona"]["trabajo"]["empresa_razon_social"]!=''){
                    $trabajo= new trabajo;
                    $trabajo->persona_id=$persona->id;;
                    if($persona->trabajo)
                        $trabajo=$persona->trabajo;
                    if(isset($args["cliente"]["persona"]["trabajo"]["empresa_ruc"]))
                        $trabajo->empresa_ruc=$args["cliente"]["persona"]["trabajo"]["empresa_ruc"];
                    if(isset($args["cliente"]["persona"]["trabajo"]["empresa_razon_social"]))
                        $trabajo->empresa_razon_social=$args["cliente"]["persona"]["trabajo"]["empresa_razon_social"];
                    if(isset($args["cliente"]["persona"]["trabajo"]["empresa_direccion"]))
                        $trabajo->empresa_direccion=$args["cliente"]["persona"]["trabajo"]["empresa_direccion"];
                    $trabajo->save();
                }
                if(isset($args["cliente"]["persona"]["conyuge"]) && $args["cliente"]["persona"]["conyuge"]["documento"]!=''){
                    $conyuge= new conyuge;
                    $conyuge->persona_id=$persona->id;;
                    if($persona->conyuge)
                        $conyuge=$persona->conyuge;
                    if(isset($args["cliente"]["persona"]["conyuge"]["documento"]))
                        $conyuge->documento=$args["cliente"]["persona"]["conyuge"]["documento"];
                    if(isset($args["cliente"]["persona"]["conyuge"]["nombres"]))
                        $conyuge->nombres=$args["cliente"]["persona"]["conyuge"]["nombres"];
                    if(isset($args["cliente"]["persona"]["conyuge"]["fecha_nacimiento"]))
                        $conyuge->fecha_nacimiento=$args["cliente"]["persona"]["conyuge"]["fecha_nacimiento"];
                    if(isset($args["cliente"]["persona"]["conyuge"]["estado_civil"]))
                        $conyuge->estado_civil=$args["cliente"]["persona"]["conyuge"]["estado_civil"];
                    if(isset($args["cliente"]["persona"]["conyuge"]["ocupacion"]))
                        $conyuge->ocupacion=$args["cliente"]["persona"]["conyuge"]["ocupacion"];
                    if(isset($args["cliente"]["persona"]["conyuge"]["telefono"]))
                        $conyuge->telefono=$args["cliente"]["persona"]["conyuge"]["telefono"];
                    if(isset($args["cliente"]["persona"]["conyuge"]["celular"]))
                        $conyuge->celular=$args["cliente"]["persona"]["conyuge"]["celular"];
                    if(isset($args["cliente"]["persona"]["conyuge"]["centro_laboral"]))
                        $conyuge->centro_laboral=$args["cliente"]["persona"]["conyuge"]["centro_laboral"];
                    if(isset($args["cliente"]["persona"]["conyuge"]["direccion_centro_laboral"]))
                        $conyuge->direccion_centro_laboral=$args["cliente"]["persona"]["conyuge"]["direccion_centro_laboral"];
                    if(isset($args["cliente"]["persona"]["conyuge"]["socio"]))
                        $conyuge->socio=$args["cliente"]["persona"]["conyuge"]["socio"];
                    if(isset($args["cliente"]["persona"]["conyuge"]["codigo_socio"]))
                        $conyuge->codigo_socio=$args["cliente"]["persona"]["conyuge"]["codigo_socio"];
                    if(isset($args["cliente"]["persona"]["conyuge"]["aporte_socio"]))
                        $conyuge->aporte_socio=$args["cliente"]["persona"]["conyuge"]["aporte_socio"];
                    if(isset($args["cliente"]["persona"]["conyuge"]["trabaja"]))
                        $conyuge->trabaja=$args["cliente"]["persona"]["conyuge"]["trabaja"];
                    $conyuge->save();
                }

            }
        }
        return $prestamo;;
    }
}
