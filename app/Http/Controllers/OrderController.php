<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Order;
use App\TaskDone;
use App\Customer;
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
        $orders = Order::orderBy('created_at','desc')->paginate(10);
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
            'name' => 'required',
            'cus_name' => 'required|regex:/(\D+)\s(\S+)[@](\S+)[.](\D+)/',
            'descp' => 'required',
            'user_name' => 'required|regex:/(\S+)\s(\S+)\s(\S+)/',
            'model_name' => 'required|regex:/(\d+)\s(\S+)(\s(\S+))*/'
        ]);
        //create post
        $order = new Order;
        $order->name = $request->input('name');
        $order->desc = $request->input('descp');
        $cus_array  = preg_split("/ /", $request->input('cus_name'));
        $order->cus_id  = DB::table('customers')
        ->where('email', "{$cus_array[2]}")->value('cus_id');
        $model_array  = preg_split("/ /", $request->input('model_name'));
        $order->model_id  = DB::table('device_models')
        ->where('imei', "{$model_array[0]}")->value('model_id');
        $order->save(); 

        /* $task_done = TaskDone::find([1]);
        $order->task()->attach($task_done); */
        $task_done = new TaskDone;
        $task_done->ord_id = $order->ord_id;
        $task_done->task_id = DB::table('tasks')
        ->where('task_id', "1")->value('task_id');
        $task_done->user_id = Auth::id();
        $task_done->save();
        return redirect('/orders')->with('success', 'Zakázka vytvořena!');
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
        $order = Order::find($id);
        //$tasks = Task::orderBy('id','desc');
        $task_done = DB::table('task_done')->where('ord_id', $id)->value('task_id');
        $tasks = DB::table('tasks')->where('task_id', '!=', $task_done)->get();
        $rep_done = DB::table('order_repair')->where('ord_id', $id)->value('rep_id');
        $repairs = DB::table('repairs')->where('rep_id', '!=', $rep_done)->get();
        return view('orders.edit')->with('order', $order)->with('tasks', $tasks)->with('repairs', $repairs);
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
        $this->validate($request,[
            'name' => 'required',
            'cus_name' => 'required|regex:/(\D+)\s(\S+)[@](\S+)[.](\D+)/',
            'descp' => 'required',
            'model_name' => 'required|regex:/(\d+)\s(\S+)(\s(\S+))*/',
            'task_sel' => 'required'
        ]);
        //create post
        $order = Order::find($id);
        $order->name = $request->input('name');
        $order->desc = $request->input('descp');
        $cus_array  = preg_split("/ /", $request->input('cus_name'));
        $order->cus_id  = DB::table('customers')
        ->where('email', "{$cus_array[2]}")->value('cus_id');
        $model_array  = preg_split("/ /", $request->input('model_name'));
        $order->model_id  = DB::table('device_models')
        ->where('imei', "{$model_array[0]}")->value('model_id');
        $order->save(); 
        $task_done = new TaskDone;
        $task_done->ord_id = $order->ord_id;
        $task_done->task_id = DB::table('tasks')
        ->where('desc', $request->input('task_sel'))->value('task_id');
        $task_done->user_id = Auth::id();
        $task_done->save();
        return redirect('/orders')->with('success', 'Zakázka upravena!'); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rep = DB::table('order_repair')
        ->where('rep_id', '=', $id)
        ->get();
        $ord_id = DB::table('order_repair')
        ->where('rep_id', '=', $id)
        ->value('ord_id');
        //$rep->delete();
        return $id;
    }

    function destroyRepair($id)
    {
        $rep = DB::table('order_repair')
        ->where('rep_id', '=', $id)
        ->get();
        $ord_id = DB::table('order_repair')
        ->where('rep_id', '=', $id)
        ->value('ord_id');
        //$rep->delete();
        return ('/orders/');
        //redirect('/orders/'.$ord_id.'/edit')
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
           <li class="cus_offer"><a href="#"><b>'.$row->name.' '.$row->surname.'</b> '.$row->email.'</a></li>';
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
           <li class="mod_offer"><a href="#"><b>'.$row->imei.'</b> '.$row->brand_name.' '.$row->model_name.'</a></li>';
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
           <li class="user_offer"><a href="#"><b>'.$row->first_name.' '.$row->last_name.'</b> '.$row->name.'</a></li>';
          }
          $output .= '</ul>'; 
          echo $output;
            }
        
    }
}
