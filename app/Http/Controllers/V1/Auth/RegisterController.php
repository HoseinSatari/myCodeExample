<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResouce;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'name' => ['required' , 'string' , 'max:50'],
            'email' => ['required' , 'email' , 'max:100' , 'unique:users'],
            'password' => ['required' , 'confirmed' , 'min:8']
        ]);

        if ($validator->fails()){
            return response([
                'data' => $validator->errors(),
                'status' => 'error',
            ] , Response::HTTP_UNPROCESSABLE_ENTITY);
        }

       $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]
        );
      return new UserResouce($user);
    }


}
