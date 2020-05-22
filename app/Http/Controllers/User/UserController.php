<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\user\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        //dd($users);
	return view('user.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
               'username' => 'required',
               'name' => 'required',
               'email' => 'required|email',
        ]);
        
        if (User::where(['username'=>$request->username, 'deleted_at'=>NULL])->doesntExist()) { // Cek data apakah sudah ada atau belum di database            
            User::create($request->all());
            return redirect('/user')->with(['kode'=>'99', 'pesan'=>'Data berhasil disampan !']);
        }else{
            return redirect('/user')->with(['kode'=>'98','pesan'=>'Data sudah ada !']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit',['users'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
               'username' => 'required',
               'name' => 'required',
               'email' => 'required|email',
        ]);
        if (User::where([
                ['username', '=', $request->username],
                ['deleted_at', '=', 'NULL'],
                ['id', '!=', $user->id]
        ])->doesntExist()) { // Cek data apakah sudah ada atau belum di database            
            User::where('id', $user->id)
              ->update([
                  'username' => $request->username,
                  'name' => $request->name,
                  'email' => $request->email,
            ]);
            return redirect('/user')->with(['kode'=>'99', 'pesan'=>'Data berhasil diubah !']);
        }else{
            return redirect('/user')->with(['kode'=>'98', 'pesan'=>'Data sudah ada !']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/user')->with(['kode'=>'99', 'pesan'=> 'Data berhasil dihapus !']);   
    }
}
