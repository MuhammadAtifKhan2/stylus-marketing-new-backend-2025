<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;

class HomeControlLer extends Controller
{
    //
    function register(Request $request)
    {
        $userData = $request->all();

        $validator = Validator::make($userData,[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|confirmed',
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>false,'errors'=>$validator->errors()]);
        }

        // dd($userData['password']);
        $userData['password'] = bcrypt($userData['password']);
        
        $user = User::create($userData);

        $user['token'] = $user->createToken('myApp')->accessToken;

        return response()->json(['result'=>'success','user'=>$user]);


    }

    public function login(Request $request)
    {
        $rules = [
            'email'=>'required',
            'password'=>'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            return response()->json(['success'=>false,'errors'=>$validator->errors()]);
        }

        if(auth()->attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            $user = auth()->user();
            $user['token'] = $user->createToken('myApp')->accessToken;
            return response()->json(['success'=>true,'result'=>$])
        }
        else
        {
            return response()->json(['success'=>false,'error'=>'invalid credentials']);
        }
    }
}
