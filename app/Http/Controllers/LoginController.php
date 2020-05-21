<?php

namespace App\Http\Controllers;

use App\Login;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
#use Illuminate\Support\Facades\Http;
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
        //$response = Http::post('http://localhost/belajar/login.php', [
        //    'username' => '02008',
        //]);        
        
        $client = new Client();
        $response = $client->request('POST', 'http://localhost/belajar/login.php', [
            'form_params' => [
                'username' => '02008',
            ]
        ]);
        
        $dtAPi = json_decode($response->getBody()->getContents(),true);  
        $responStatus = $response->getStatusCode();
        if($responStatus=='200'){
            #dd($dtAPi);
            #echo $dtAPi['username'];
            //dd(Auth::loginUsingId('2'));
            #if(Auth::attempt($request->only('username','password'))){
            #}
            
            $getUser = Login::where(['username' => $request->username])->first();
            #dd($getUser->id);
            if ($getUser === null) {
                return redirect('login')->with('pesan', 'User tidak terdaftar diportal !');
            }else{
                if(Auth::loginUsingId($getUser->id)){
                    return redirect('/');
                 }else{
                    return redirect('login')->with('pesan', 'Username tidak terdaftar !');
                 }   
            }
        }else{
            return redirect('login')->with('pesan', 'Gagal login ke sistem !');
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
