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

class ArticlesQuery extends Query
{
    protected $attributes = [
        'name' => 'articles',
        'description' => 'query for all Articles'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('articleType');
    }

    public function args(): array
    {
        return [
              'page' => [
                  'type' => Type::int()
              ],
            'limit' => [
                'type' => Type::int()
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
       $page = $args['page'] ?? 1;
       $limit = $args['limit'] ?? 10;

       $articles = Article::paginate($limit , ['*'] , 'page' , $page);

        return $articles;
    }
}
