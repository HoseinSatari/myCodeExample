<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ArticlesType extends GraphQLType
{
    protected $attributes = [
        'name' => 'articleType',
        'description' => 'Type For Articles'
    ];

    public function fields(): array
    {
        return [
            'user_id' => [
                 'type' => Type::int()
            ],
            'title' => [
                'type' => Type::string()
            ],
            'body' => [
                'type' => Type::string()
            ],
            'poster' => [
                'type' => Type::string()
            ],
            'categories' => [
                'type' => Type::listOf(GraphQL::type('categoryType'))
            ]
        ];
    }
}
