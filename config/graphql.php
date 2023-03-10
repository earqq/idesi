<?php

declare(strict_types=1);

use example\Mutation\ExampleMutation;
use example\Query\ExampleQuery;
use example\Type\ExampleRelationType;
use example\Type\ExampleType;
use App\GraphQL\Types\ArchivoType;
return [

    // The prefix for routes
    'prefix' => 'graphql',

    // The routes to make GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Route
    //
    // Example:
    //
    // Same route for both query and mutation
    //
    // 'routes' => 'path/to/query/{graphql_schema?}',
    //
    // or define each route
    //
    // 'routes' => [
    //     'query' => 'query/{graphql_schema?}',
    //     'mutation' => 'mutation/{graphql_schema?}',
    // ]
    //
    'routes' => '{graphql_schema?}',

    // The controller to use in GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Controller and method
    //
    // Example:
    //
    // 'controllers' => [
    //     'query' => '\Rebing\GraphQL\GraphQLController@query',
    //     'mutation' => '\Rebing\GraphQL\GraphQLController@mutation'
    // ]
    //
    'controllers' => \Rebing\GraphQL\GraphQLController::class.'@query',

    // Any middleware for the graphql route group
    'middleware' => [
        \App\Http\Middleware\Cors::class
    ],

    // Additional route group attributes
    //
    // Example:
    //
    // 'route_group_attributes' => ['guard' => 'api']
    //
    'route_group_attributes' => [],

    // The name of the default schema used when no argument is provided
    // to GraphQL::schema() or when the route is used without the graphql_schema
    // parameter.
    'default_schema' => 'default',

    // The schemas for query and/or mutation. It expects an array of schemas to provide
    // both the 'query' fields and the 'mutation' fields.
    //
    // You can also provide a middleware that will only apply to the given schema
    //
    // Example:
    //
    //  'schema' => 'default',
    //
    //  'schemas' => [
    //      'default' => [
    //          'query' => [
    //              'users' => 'App\GraphQL\Query\UsersQuery'
    //          ],
    //          'mutation' => [
    //
    //          ]
    //      ],
    //      'user' => [
    //          'query' => [
    //              'profile' => 'App\GraphQL\Query\ProfileQuery'
    //          ],
    //          'mutation' => [
    //
    //          ],
    //          'middleware' => ['auth'],
    //      ],
    //      'user/me' => [
    //          'query' => [
    //              'profile' => 'App\GraphQL\Query\MyProfileQuery'
    //          ],
    //          'mutation' => [
    //
    //          ],
    //          'middleware' => ['auth'],
    //      ],
    //  ]
    //
    'schemas' => [
        'default' => [
            'query' => [
                'prestamos'=>App\GraphQL\Queries\PrestamosQuery::class,
                'clientes'=>App\GraphQL\Queries\ClientesQuery::class,
                'negocios'=>App\GraphQL\Queries\NegociosQuery::class,
                'departamentos'=>App\GraphQL\Queries\DepartamentosQuery::class,
                'provincias'=>App\GraphQL\Queries\ProvinciasQuery::class,
                'distritos'=>App\GraphQL\Queries\DistritosQuery::class,
            ],
            'mutation' => [
                'prestamos'=>App\GraphQL\Mutations\PrestamosMutation::class,
            ],
            'types' => [
                'clienteInput' => App\GraphQL\Inputs\ClienteInput::class,                 
                'cualitativaInput' => App\GraphQL\Inputs\CualitativaInput::class,
                'personaInput' => App\GraphQL\Inputs\PersonaInput::class,                 
                'trabajoInput' => App\GraphQL\Inputs\TrabajoInput::class,               
                'conyugeInput' => App\GraphQL\Inputs\ConyugeInput::class,               
            ],
            'middleware' => [\App\Http\Middleware\Cors::class],
            'method' => ['get', 'post'],
        ],
    ],

    // The types available in the application. You can then access it from the
    // facade like this: GraphQL::type('user')
    //
    // Example:
    //
    // 'types' => [
    //     'user' => 'App\GraphQL\Type\UserType'
    // ]
    //
    'types' => [
        'archivo' => 'App\GraphQL\Types\ArchivoType',
        'aval' => 'App\GraphQL\Types\AvalType',
        'cliente' => 'App\GraphQL\Types\ClienteType',
        'cualitativa' => 'App\GraphQL\Types\CualitativaType',
        'evaluacion' => 'App\GraphQL\Types\EvaluacionType',
        'garantia' => 'App\GraphQL\Types\GarantiaType',
        'prestamo' => 'App\GraphQL\Types\PrestamoType',
        'resultadoAnalisis' => 'App\GraphQL\Types\ResultadoAnalisisType',
        'user' => 'App\GraphQL\Types\UserType',
        'persona' => App\GraphQL\Types\PersonaType::class,
        'empresa' => App\GraphQL\Types\EmpresaType::class,
        'representante' => App\GraphQL\Types\RepresentanteLegalType::class,
        'trabajo' => App\GraphQL\Types\TrabajoType::class,
        'negocio' => App\GraphQL\Types\NegocioType::class,
        'departamento' => App\GraphQL\Types\DepartamentoType::class,
        'provincia' => App\GraphQL\Types\ProvinciaType::class,
        'distrito' => App\GraphQL\Types\DistritoType::class,
        'clienteInput' => App\GraphQL\Inputs\ClienteInput::class,                 
        'cualitativaInput' => App\GraphQL\Inputs\CualitativaInput::class,
        'personaInput' => App\GraphQL\Inputs\PersonaInput::class,                 
        'trabajoInput' => App\GraphQL\Inputs\TrabajoInput::class,
        'conyugeInput' => App\GraphQL\Inputs\ConyugeInput::class,
        'empresaInput' => App\GraphQL\Inputs\EmpresaInput::class,
        'representanteInput' => App\GraphQL\Inputs\RepresentanteLegalInput::class,
    ],

    // The types will be loaded on demand. Default is to load all types on each request
    // Can increase performance on schemes with many types
    // Presupposes the config type key to match the type class name property
    'lazyload_types' => false,

    // This callable will be passed the Error object for each errors GraphQL catch.
    // The method should return an array representing the error.
    // Typically:
    // [
    //     'message' => '',
    //     'locations' => []
    // ]
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],

    /*
     * Custom Error Handling
     *
     * Expected handler signature is: function (array $errors, callable $formatter): array
     *
     * The default handler will pass exceptions to laravel Error Handling mechanism
     */
    'errors_handler' => ['\Rebing\GraphQL\GraphQL', 'handleErrors'],

    // You can set the key, which will be used to retrieve the dynamic variables
    'params_key' => 'variables',

    /*
     * Options to limit the query complexity and depth. See the doc
     * @ https://webonyx.github.io/graphql-php/security
     * for details. Disabled by default.
     */
    'security' => [
        'query_max_complexity' => null,
        'query_max_depth' => null,
        'disable_introspection' => false,
    ],

    /*
     * You can define your own pagination type.
     * Reference \Rebing\GraphQL\Support\PaginationType::class
     */
    'pagination_type' => \Rebing\GraphQL\Support\PaginationType::class,

    /*
     * Config for GraphiQL (see (https://github.com/graphql/graphiql).
     */
    'graphiql' => [
        'prefix' => '/graphiql',
        'controller' => \Rebing\GraphQL\GraphQLController::class.'@graphiql',
        'middleware' => [],
        'view' => 'graphql::graphiql',
        'display' => env('ENABLE_GRAPHIQL', true),
    ],

    /*
     * Overrides the default field resolver
     * See http://webonyx.github.io/graphql-php/data-fetching/#default-field-resolver
     *
     * Example:
     *
     * ```php
     * 'defaultFieldResolver' => function ($root, $args, $context, $info) {
     * },
     * ```
     * or
     * ```php
     * 'defaultFieldResolver' => [SomeKlass::class, 'someMethod'],
     * ```
     */
    'defaultFieldResolver' => null,

    /*
     * Any headers that will be added to the response returned by the default controller
     */
    'headers' => [],

    /*
     * Any JSON encoding options when returning a response from the default controller
     * See http://php.net/manual/function.json-encode.php for the full list of options
     */
    'json_encoding_options' => 0,
];
