<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TestController extends Controller
{
    //
    function test()
    {
        $userData = [
            'name'=>'Atif',
            'email'=>'atif@gmail.com',
            'password'=>bcrypt('123456'),

        ];
        $user = User::find(4);

        $token = $user->createToken('MyApp')->accessToken;

        dd($token);

    }
}
