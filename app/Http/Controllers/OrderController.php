<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use DB;
class OrderController extends Controller
{
       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('date_acceptance','desc')->get();
        // $orders = Order::orderBy('date_acceptance','desc')->take(1)->get();
        //return Order::where('id_ord', '2')->get();
        $orders = Order::orderBy('date_acceptance','desc')->paginate(2);
        return view('orders.index')->with('orders',$orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'model' => 'required',
            'imei' => 'required',
            'brand_name' => 'required'
        ]);
        //create post
        $order = new Order;
        $order->model_name = $request->input('model');
        $order->imei = $request->input('imei');
        $order->brand_id  = DB::table('device_brands')
        ->where('brand_name', "{$request->input('brand_name')}")->value('brand_id');
        $order->save(); 
        
        
        return redirect('/models')->with('success', 'Telefon uložen!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('orders.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    function fetch(Request $request)
    {
    
           
        
         if($request->get('query'))
         {
       $query = $request->get('query');
       $data = DB::table('customers')
           ->where('email', 'LIKE', "{$query}%")
           ->get();
      
          $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
       foreach($data as $row)
          {
       $output .= '
           <li><a href="#"><b>'.$row->name.' '.$row->surname.'</b> '.$row->email.'</a></li>';
          }
          $output .= '</ul>';
          echo $output;
            }
        
    }
    function fetchMod(Request $request)
    {
    
           
        
         if($request->get('query'))
         {
       $query = $request->get('query');
       $data = DB::table('device_models')
           ->join('device_brands', 'device_models.brand_id', '=', 'device_brands.brand_id')
           ->where('imei', 'LIKE', "{$query}%")
           ->get();
      
          $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
        foreach($data as $row)
          {
       $output .= '
           <li><a href="#"><b>'.$row->imei.'</b> '.$row->brand_name.' '.$row->model_name.'</a></li>';
          }
          $output .= '</ul>'; 
          echo $output;
            }
        
    }
    function fetchStaff(Request $request)
    {
    
           
        
         if($request->get('query'))
         {
       $query = $request->get('query');
       $data = DB::table('users')
           ->join('roles', 'users.role_id', '=', 'roles.role_id')
           ->where('first_name', 'LIKE', "{$query}%")
           ->get();
      
          $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
        foreach($data as $row)
          {
       $output .= '
           <li><a href="#"><b>'.$row->first_name.' '.$row->last_name.'</b> '.$row->name.'</a></li>';
          }
          $output .= '</ul>'; 
          echo $output;
            }
        
    }
}
