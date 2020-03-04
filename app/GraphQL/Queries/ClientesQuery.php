<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL;
use App\Cliente;
class ClientesQuery extends Query
{
    protected $attributes = [
        'name' => 'clientes',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('cliente'));
    }

    public function args(): array
    {
        return [
            'search' => ['name' => 'search', 'type' => Type::string()],
            'id' => ['name' => 'id', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();
        $fields = $resolveInfo->getFieldSelection($depth = 5);
        $clientes= cliente::query();
        foreach ($fields as $field => $keys) {
            if ($field === 'persona') {
                $clientes->with('persona');
            }
            if ($field === 'empresa') {
                $clientes->with('empresa');
            }
        }       
        
        if(isset($args["id"]))
            $clientes->where('id',$args["id"]);
        if(isset($args["search"])){
            $text=strtoupper($args["search"]);
            if($text!=''){
                $clientes->where(function($query) use($text){
                    $query->whereHas('persona',function ($query) use($text){
                        $query->where('nombres','LIKE', "%{$text}%")
                        ->orWhere('apellidos','LIKE', "%{$text}%");
                    })
                    ->orWhere('documento', 'LIKE', "%{$text}%")
                    ->orWhereHas('empresa',function($query) use($text){
                        $query->where('razon_social', 'LIKE', "%{$text}%");
                    });
                });
            }
        }
        return $clientes->get();
    }
}
