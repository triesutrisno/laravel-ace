<?php

namespace App\Http\Controllers;

use App\Login;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postlogin(Request $request)
    {
        $request->validate([
                'username' => 'required',
                'password' => 'required',
        ]);
        
        if(Auth::attempt($request->only('username','password'))){
            return redirect('/');
        }else{
            return redirect('login')->with('pesan', 'Username atau Password !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
		return redirect('login');
    }
}
