<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getlogin()
    {
        return view("login");
    }

    public function dologin(Request $request)
    {
        $credentials=[
            'password'=>$request->password
        ];
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $credentials["email"]=$request->username;
        } else {
            $credentials["username"]=$request->username;
        }

        if (Auth::attempt($credentials)) {
            return redirect()->route('site.home');
        } else {
            return redirect()->route('website.getlogin')->with("message","Đăng nhập không thành công");
        }
    }

}
