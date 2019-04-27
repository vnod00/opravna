<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Vítejte v aplikaci Opravna';
        //return view('pages.index' , compact('title'));
        return view('pages.index')->with('title',  $title);
    }
    public function about(){
        $title = 'Suck my about!';
        //return view('pages.index' , compact('title'));
        return view('pages.about')->with('title',  $title);
    }
   
}
