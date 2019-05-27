<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Order;
use App\TaskDone;
use App\Customer;
use App\Mail\OrderDone;
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
        $orders = Order::orderBy('ord_id','asc')->paginate(10);
        
        return view('orders.index')->with('orders',$orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'prodavac']);
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
        $request->user()->authorizeRoles(['admin', 'prodavac']);
        $this->validate($request,[
            'name' => 'required|max:80',
            'cus_email' => 'required|exists:customers,email',
            'descp' => 'required',
            'model_imei' => 'required|exists:device_models,imei',
            'acc_date' => 'required|date_format:Y-m-d',
            'hand_date' => 'nullable|date_format:Y-m-d'
        ]);
        //create post
        $order = new Order;
        $order->name = $request->input('name');
        $order->desc = $request->input('descp'); 
        $order->date_acceptance = $request->input('acc_date');  
        $order->cus_id  = DB::table('customers')
        ->where('email', "{$request->input('cus_email')}")->value('cus_id');
        $order->model_id  = DB::table('device_models')
        ->where('imei', "{$request->input('model_imei')}")->value('id');
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

        $task_done = DB::table('task_done')->where('ord_id', $id)->pluck('task_id');
        $task_name = DB::table('tasks')->where('task_id', $task_done)->value('desc');
        $tasks = DB::table('tasks')->whereNotIn('task_id', $task_done)->get();
        $rep_done = DB::table('order_repair')->where('ord_id', $id)->pluck('rep_id');
        
        $repairs = DB::table('repairs')->whereNotIn('rep_id', $rep_done)->get();
        
        return view('orders.edit')->with('order', $order)->with('tasks', $tasks)->with('repairs', $repairs)->with('task_name', $task_name);
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
            'cus_email' => 'required|exists:customers,email',
            'descp' => 'required',
            'model_imei' => 'required|exists:device_models,imei',
            'rep_sel' => 'nullable|exists:repairs,name',
            'task_sel' => 'nullable|exists:tasks,desc',
            'acc_date' => 'required|date_format:Y-m-d',
            'hand_date' => 'nullable|required_if:task_sel,Zakázka vyhotovena|date_format:Y-m-d|after_or_equal:acc_date'
        ]);
        //create postp
        $order = Order::find($id);
        $order->name = $request->input('name');
        $order->desc = $request->input('descp');    
        $order->cus_id  = DB::table('customers')
        ->where('email', "{$request->input('cus_email')}")->value('cus_id');
        $order->model_id  = DB::table('device_models')
        ->where('imei', "{$request->input('model_imei')}")->value('id');
        $order->date_acceptance = $request->input('acc_date');
       // $dd = $request->input('task_sel');
        if ($request->input('task_sel') == 'Zakázka vyhotovena') {
            $order->date_handover = $request->input('hand_date');
        }
        $order->save();
        
        if (($request->input('task_sel')) != []) {
            $task_done = TaskDone::find($id);
            $task_done->user_id = Auth::id(); 
            $task_id = DB::table('tasks')
            ->where('desc', $request->input('task_sel'))->value('task_id');
            $task_done->task_id = $task_id;            
            $task_done->save();
            if ($task_id == 3) {
                $user = $order->customer;
                \Mail::to($user)->send(new OrderDone);
            }
        }
        
        if (($request->input('rep_sel')) != []) {
            $repair = DB::table('repairs')
            ->where('name', $request->input('rep_sel'))->value('rep_id');    
            Order::find($id)->repair()->attach($repair);
        }
        
        return redirect('orders/'.$id)->with('success', 'Zakázka upravena!'); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin', 'prodavac']);
        $order = Order::find($id);
        $order->delete();
        return redirect('orders')->with('success', 'Zakázka vymazána!');
    }

    public function destroyRepair(Request $request, $id, $rep_id)
    {
        $request->user()->authorizeRoles(['admin', 'opravar']);
          DB::table('order_repair')
        ->where('ord_id', '=', $id)
        ->where('rep_id', '=', $rep_id)
        ->delete(); 
       // Order::find($id)->repair()->delete($rep_id);
        return redirect('orders/'.$id.'/edit')->with('success', 'Oprava vymazána!');
        
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
           <li class="cus_offer"><a href="#"><b>'.$row->email.'</a></li>';
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
           <li class="mod_offer"><a href="#"><b>'.$row->imei.'</a></li>';
          }
          $output .= '</ul>'; 
          
          echo $output;
          
            }
        
    }

}
