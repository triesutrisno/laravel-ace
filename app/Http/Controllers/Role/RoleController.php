<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Model\Role\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        //dd($roles);
	return view('role.index',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create');
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
               'role_nama' => 'required',
        ]);
        
        if (Role::where(['role_nama'=>$request->role_nama, 'role_status'=>'1', 'deleted_at'=>NULL])->doesntExist()) { // Cek data apakah sudah ada atau belum di database            
            Role::create($request->all());
            return redirect('/role')->with(['kode'=>'99', 'pesan'=>'Data berhasil disampan !']);
        }else{
            return redirect('/role')->with(['kode'=>'98','pesan'=>'Data sudah ada !']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //dd($role);
        return view('role.edit',['role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {        
        $request->validate([
               'role_nama' => 'required',
        ]);
        if (Role::where([
                ['role_nama', '=', $request->role_nama],
                ['role_status', '=', '1'],
                ['deleted_at', '=', 'NULL'],
                ['role_nama', '!=', $role->role_nama]
        ])->doesntExist()) { // Cek data apakah sudah ada atau belum di database            
            Role::where('role_nama', $role->role_nama)
              ->update([
                  'role_nama' => $request->role_nama,
                  'role_keterangan' => $request->role_keterangan,
                  'role_status' => $request->role_status,
            ]);
            return redirect('/role')->with(['kode'=>'99', 'pesan'=>'Data berhasil diubah !']);
        }else{
            return redirect('/role')->with(['kode'=>'98', 'pesan'=>'Data sudah ada !']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Role::destroy($role->role_nama);
        return redirect('/role')->with(['kode'=>'99', 'pesan'=> 'Data berhasil dihapus !']);   
    }
}
