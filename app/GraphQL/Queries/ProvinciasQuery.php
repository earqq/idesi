<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use Graphql;
use App\Provincia;
class ProvinciasQuery extends Query
{
    protected $attributes = [
        'name' => 'provincias',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('provincia'));
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return provincia::all();
    }
}
