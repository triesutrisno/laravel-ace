<?php

namespace App\Http\Controllers\Userrole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\Userrole\Userrole;
use App\Http\Model\Role\Role;
use App\Http\Model\User\User;
use App\Http\Model\menurole\Menurole;
use App\Http\Model\aksesuser\Aksesuser;
use Illuminate\Support\Facades\DB;

class UserroleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userroles = Userrole::all();
	return view('userrole.index',['userroles'=>$userroles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $roles = Role::all();
        return view('userrole.create',['users'=>$users, 'roles'=>$roles]);
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
               'role_nama' => 'required',
        ]);
        
        //dd($request);
        
        if (Userrole::where(['username'=>$request->username,'role_nama'=>$request->role_nama, 'userrole_status'=>'1'])->doesntExist()) { // Cek data apakah sudah ada atau belum di database            
            $insert = Userrole::create($request->all());            
            try {
                $insAksesuser = [];
                $menuRoles = Menurole::where(['role_nama'=>$request->role_nama])->get();
                foreach($menuRoles as $menuRole) {
                    $insAksesuser[] = [ 'menu_id' => $menuRole->menu_id,
                           'role_nama' => $request->role_nama, 
                           'username' => $request->username , 
                           'aksesuser_status' => $request->userrole_status]; 
                }
                DB::table('aksesuser')->insert($insAksesuser);
            } catch (Throwable $e) {
                return false;
            }
            return redirect('/userrole')->with(['kode'=>'99', 'pesan'=>'Data berhasil disampan !']);
        }else{
            return redirect('/userrole')->with(['kode'=>'98','pesan'=>'Data sudah ada !']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Model\Userrole\Userrole  $userrole
     * @return \Illuminate\Http\Response
     */
    public function show(Userrole $userrole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Model\Userrole\Userrole  $userrole
     * @return \Illuminate\Http\Response
     */
    public function edit(Userrole $userrole)
    {
        $users = User::all();
        $roles = Role::where(['role_status'=>'1'])->get();
        //dd($roles);
        return view('userrole.edit',['userroles'=>$userrole, 'users'=>$users, 'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Model\Userrole\Userrole  $userrole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Userrole $userrole)
    {
        $request->validate([
               'username' => 'required',
               'role_nama' => 'required',
        ]);
        if (Userrole::where([
                ['username', '=', $request->username],
                ['role_nama', '=', $request->role_nama],
                ['userrole_status', '=', $request->userrole_status],
                ['userrole_id', '!=', $userrole->userrole_id]
        ])->doesntExist()) { // Cek data apakah sudah ada atau belum di database            
            Userrole::where('userrole_id', $userrole->userrole_id)
              ->update([
                  'username' => $request->username,
                  'role_nama' => $request->role_nama,
                  'userrole_status' => $request->userrole_status,
            ]);
            
            try {
                $del = Aksesuser::where(['username'=>$userrole->username, 'role_nama'=>$userrole->role_nama])->delete();
                $insAksesuser = [];
                $menuRoles = Menurole::where(['role_nama'=>$request->role_nama])->get();
                foreach($menuRoles as $menuRole) {
                    $insAksesuser[] = [ 'menu_id' => $menuRole->menu_id,
                           'role_nama' => $request->role_nama, 
                           'username' => $request->username , 
                           'aksesuser_status' => $request->userrole_status]; 
                }
                DB::table('aksesuser')->insert($insAksesuser);
            } catch (Throwable $e) {
                return false;
            }
            return redirect('/userrole')->with(['kode'=>'99', 'pesan'=>'Data berhasil diubah !']);
        }else{
            return redirect('/userrole')->with(['kode'=>'98', 'pesan'=>'Data sudah ada !']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Model\Userrole\Userrole  $userrole
     * @return \Illuminate\Http\Response
     */
    public function destroy(Userrole $userrole)
    {
        Userrole::destroy($userrole->userrole_id);
        return redirect('/userrole')->with(['kode'=>'99', 'pesan'=> 'Data berhasil dihapus !']);   
    }
}
