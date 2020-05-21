<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Http\Model\Menu\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
	return view('menu.index',compact('menus')); // fungsi compact digunakan jika nama variabel dan nama parameternya sama
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menusdtParent = Menu::all();
        return view('menu.create',['menus'=>$menusdtParent]);
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
               'menu_nama' => 'required',
        ]);
        
        if (Menu::where(['menu_nama'=>$request->menu_nama, 'menu_status'=>'1', 'deleted_at'=>NULL])->doesntExist()) { // Cek data apakah sudah ada atau belum di database            
            Menu::create($request->all());
            return redirect('/menu')->with(['kode'=>'99', 'pesan'=>'Data berhasil disampan !']);
        }else{
            return redirect('/menu')->with(['kode'=>'98','pesan'=>'Data sudah ada !']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Model\Menu\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        $dtParent = Menu::find($menu->menu_parent);
        if($dtParent === null){
            $parentNama = "";
        }else{
            $parentNama = $dtParent->menu_nama;            
        }
        return view('menu.show',['menu'=>$menu, 'parentDesc'=>$parentNama]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Model\Menu\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $menusdtParent = Menu::all();
        return view('menu.edit',['menu'=>$menu, 'parents'=>$menusdtParent]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Model\Menu\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
               'menu_nama' => 'required',
        ]);
        if (Menu::where([
                ['menu_nama', '=', $request->menu_nama],
                ['menu_status', '=', '1'],
                ['deleted_at', '=', 'NULL'],
                ['menu_id', '!=', $menu->menu_id]
        ])->doesntExist()) { // Cek data apakah sudah ada atau belum di database            
            Menu::where('menu_id', $menu->menu_id)
              ->update([
                  'menu_nama' => $request->menu_nama,
                  'menu_link' => $request->menu_link,
                  'menu_keterangan' => $request->menu_keterangan,
                  'menu_parent' => $request->menu_parent,
                  'menu_type' => $request->menu_type,
                  'menu_status' => $request->menu_status,
                  'menu_sort' => $request->menu_sort,
            ]);
            return redirect('/menu')->with(['kode'=>'99', 'pesan'=>'Data berhasil diubah !']);
        }else{
            return redirect('/menu')->with(['kode'=>'98', 'pesan'=>'Data sudah ada !']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Model\Menu\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        Menu::destroy($menu->menu_id);
        return redirect('/menu')->with(['kode'=>'98', 'pesan'=> 'Data berhasil dihapus !']);
    }
}
