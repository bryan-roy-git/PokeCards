<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRegisterController;
use Illuminate\Support\Facades\Validator;
// use Validator;
// use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RegisterController extends ApiResponseController
{
    public function index()
    {
        $pokemons = Pokemon::orderBy('created_at','desc')->paginate(10);
        return $this->successResponse($pokemons);
    }
    
    public function store(Request $request) {
        // dd($request->all()['nick']);
        $validator = Validator::make($request->all(), StoreRegisterController::myRules());

        $nick=$request->all()['nick'];
        $email=$request->all()['email'];
        $password=$request->all()['password'];
        // $nick=$request->input('nick');
        // return $this->successResponse($nick);

        // dd($nick);
        if ($validator->fails()) {
            // return $validator->errors();
            return $this->errorResponse($validator->errors($validator));
        }else{
            User::create([
                'nick' => $nick,
                'email' => $email,
                'password' => Hash::make($password),
            ]);
            // dd($validator->validated()); 

            return $this->successResponse("exito");
            }
        
    }

}
