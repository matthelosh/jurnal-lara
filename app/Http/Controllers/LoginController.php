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
                $request->session()->put('wali', false);
                return redirect('/dashboard');
            }
            else if(Auth::user()->level == 'guru')
            {
                $wali = \App\Rombel::where('guru_id', Auth::user()->nip)->first();
                if ($wali) {
                    $request->session()->put('wali', true);
                    return redirect('/guru/dashboard');
                } else {
                    $request->session()->put('wali', false);
                    return redirect('/guru/dashboard');
                }
                
            }
            // return redirect('/dashboard');
    	}
    	else
    	{
    		return back()->withError('Login Gagal');
    	}
    }
}
