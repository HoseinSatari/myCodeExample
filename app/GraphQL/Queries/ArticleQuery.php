<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Article;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class ArticleQuery extends Query
{
    protected $attributes = [
        'name' => 'Single Article',
        'description' => 'A query for single Article'
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('articleType'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
       $article = Article::find($args['id']);

        return $article;
    }
}
