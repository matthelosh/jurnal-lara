<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function authenticate(Request $request)
    {
    	$credentials = $request->only('username', 'password');

    	if(Auth::attempt($credentials))
    	{
    		if(Auth::user()->level == 'admin')
            {
                return redirect('/dashboard');
            }
            else if(Auth::user()->level == 'guru')
            {
                return redirect('/'.Auth::user()->username.'/profil');
            }
    	}
    	else
    	{
    		return back()->withError('Login Gagal');
    	}
    }
}
