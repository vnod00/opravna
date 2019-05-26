<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{ 
    public function index(){      
        if (Auth::id()) {
            $orders = Order::orderBy('ord_id','asc')->paginate(10);
        
            return view('orders.index')->with('orders',$orders);
        } else {
            $title = 'Vítejte v aplikaci Opravna';
            //return view('pages.index' , compact('title'));
            return view('pages.index')->with('title',  $title);
        }
        

    }
    public function about(){
        $title = 'Suck my about!';
        //return view('pages.index' , compact('title'));
        return view('pages.about')->with('title',  $title);
    }
   
}
