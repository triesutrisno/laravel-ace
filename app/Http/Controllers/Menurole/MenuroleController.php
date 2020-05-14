<?php

namespace App\Http\Controllers\Menurole;

use App\Http\Controllers\Controller;
use App\Http\Model\Menurole\Menurole;
use App\Http\Model\Menu\Menu;
use Illuminate\Http\Request;

class MenuroleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuroles = Menurole::all();
        //dd($roles);
	return view('menurole.index',['menuroles'=>$menuroles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all();
        return view('menurole.create',['menus'=>$menus]);
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
               'menu_id' => 'required',
               'role_nama' => 'required',
        ]);
        
        if (Menurole::where(['menu_id'=>$request->menu_id,'role_nama'=>$request->role_nama, 'menurole_status'=>'1', 'deleted_at'=>NULL])->doesntExist()) { // Cek data apakah sudah ada atau belum di database            
            Menurole::create($request->all());
            return redirect('/menurole')->with(['kode'=>'99', 'pesan'=>'Data berhasil disampan !']);
        }else{
            return redirect('/menurole')->with(['kode'=>'98','pesan'=>'Data sudah ada !']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menurole  $menurole
     * @return \Illuminate\Http\Response
     */
    public function show(Menurole $menurole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menurole  $menurole
     * @return \Illuminate\Http\Response
     */
    public function edit(Menurole $menurole)
    {
        $menus = Menu::all();
        return view('menurole.edit',['menurole'=>$menurole,'menus'=>$menus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menurole  $menurole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menurole $menurole)
    {
        $request->validate([
               'menu_id' => 'required',
               'role_nama' => 'required',
        ]);
        if (Menurole::where([
                ['menu_id', '=', $request->menu_id],
                ['role_nama', '=', $request->role_nama],
                ['menurole_status', '=', '1'],
                ['menurole_id', '!=', $menurole->menurole_id]
        ])->doesntExist()) { // Cek data apakah sudah ada atau belum di database            
            Menurole::where('menurole_id', $menurole->menurole_id)
              ->update([
                  'menu_id' => $request->menu_id,
                  'role_nama' => $request->role_nama,
                  'menurole_status' => $request->menurole_status,
            ]);
            return redirect('/menurole')->with(['kode'=>'99', 'pesan'=>'Data berhasil diubah !']);
        }else{
            return redirect('/menurole')->with(['kode'=>'98', 'pesan'=>'Data sudah ada !']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menurole  $menurole
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menurole $menurole)
    {
        Menurole::destroy($menurole->menurole_id);
        return redirect('/menurole')->with(['kode'=>'99', 'pesan'=> 'Data berhasil dihapus !']);   
    }
}
