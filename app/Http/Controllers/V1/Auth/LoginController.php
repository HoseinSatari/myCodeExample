<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResouce;
use App\Http\Resources\v1\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'email' => 'required|exists:users',
            'password' => 'required'
        ]);

        if ($validator->fails()){
            return response([
                'data' => $validator->errors(),
                'status' => 'error',
            ] , Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (! auth()->attempt($request->all())){
            return response([
                'data' => [
                    'error_message' => 'username and password dosent have match'
                ],
                'status' => 'error'
            ] , 403);
        }


        return \response()->json([
            'data' => [
                'token' => auth()->user()->createToken('api token')->plainTextToken
            ],
            'status' => true,
        ]);
    }
}
