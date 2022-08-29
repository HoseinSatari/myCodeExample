<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'categoryType',
        'description' => 'Type For Category'
    ];

    public function fields(): array
    {
        return [
              'title' => [
                  'type' => Type::string()
              ]
        ];
    }
}
