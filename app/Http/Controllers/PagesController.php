<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        
        return view('index');
    }

    public function about(){
        return view('about', ['nama' => 'Muhammad Trie Sutrisno']);
    }

    public function login(){
        return view('layout.login');
    }
}
