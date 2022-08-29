<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Auth;

use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Hash;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class Register extends Mutation
{
    protected $attributes = [
        'name' => 'auth/Register',
        'description' => 'A mutation for register'
    ];

    public function type(): Type
    {
        return GraphQL::type('userType');
    }

    public function args(): array
    {
        return [
            'name' => [
                'type' => Type::string()
            ],
            'email' => [
                'type' => Type::string()
            ],
            'password' => [
                'type' => Type::string()
            ]
        ];
    }
       protected function rules(array $args = []): array
       {
           return [
               'name' => ['required' , 'string'],
               'email' => ['required' , 'email' , 'unique:users'],
               'password' => ['required' , 'min:8']
           ];
       }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $user = User::create([
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => Hash::make($args['password'])
        ]);

        return $user;
    }
}
