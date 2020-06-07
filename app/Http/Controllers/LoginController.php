<?php

namespace App\Http\Controllers;

use App\Login;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
#use Illuminate\Support\Facades\Http;
use Auth;
use Illuminate\Support\Facades\DB;

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
        $response = $client->request('POST', 'http://119.252.168.253/api_siwa/userpass', 
            [
            // $response = $client->request('POST', 'http://localhost/api_siwa/userpass', [
            'form_params' => [
                'SID-API-KEY' => 'SIWA-DWH-2020',
                'username' => $request->username,
                'password' => $request->password,
            ],
        ]);

        $dtAPi = json_decode($response->getBody()->getContents(), true);
        $responStatus = $response->getStatusCode();
        if ($responStatus == '200') {
            #dd($dtAPi);
            #echo $dtAPi['username'];
            //dd(Auth::loginUsingId('2'));
            #if(Auth::attempt($request->only('username','password'))){
            #}

            $getUser = Login::where(['username' => $request->username, 'deleted_at'=>NULL])->first();
            //dd($getUser);
            if ($getUser === null) {
                return redirect('login')->with('pesan', 'User tidak terdaftar diportal !');
            } else {
                if (Auth::loginUsingId($getUser->id)) {
                    $hakAkses = DB::table('userrole AS a')
                        ->join('menurole AS b', 'a.role_nama', '=', 'b.role_nama')
                        ->join('menu AS c', 'b.menu_id', '=', 'c.menu_id')
                        ->select('a.username', 'a.role_nama', 'b.menu_id', 'c.menu_nama', 'c.menu_link', 'c.menu_type', 'c.menu_parent')
                        ->where([
                            ['a.userrole_status', '=', '1'],
                            ['b.menurole_status', '=', '1'],
                            ['c.menu_status', '=', '1'],
                            ['a.username', '=', $request->username]
                        ])
                        ->orderBy('c.menu_sort', 'ASC')
                        ->get();
                    //dd($hakAkses);
                    $dtAkses = [];
                    if (!empty($hakAkses)) {
                        foreach ($hakAkses as $key => $val) {
                            if ($val->menu_type == '1') {
                                $dtAkses[$val->menu_id]['menu_id'] = $val->menu_id;
                                $dtAkses[$val->menu_id]['menu_nama'] = $val->menu_nama;
                                $dtAkses[$val->menu_id]['menu_link'] = $val->menu_link;
                                $dtAkses[$val->menu_id]['menu_type'] = $val->menu_type;
                            } else if ($val->menu_type == '2') {
                                $parent1['menu_id'] = $val->menu_id;
                                $parent1['menu_nama'] = $val->menu_nama;
                                $parent1['menu_link'] = $val->menu_link;
                                $parent1['menu_type'] = $val->menu_type;

                                $dtAkses[$val->menu_parent]['data1'][] = $parent1;
                            }
                        }
                    }
                    //dd($dtAkses);
                    //exit;
                    $request->session()->put('hakAkses', $dtAkses);
                    return redirect('/');
                } else {
                    return redirect('login')->with('pesan', 'Username tidak terdaftar !');
                }
            }
        } else {
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
