<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use DB;
class CustomerController extends Controller
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
      // return $models = DeviceBrand::with('model')->get();
      //$models = DeviceModel::find(1)->model;
     $cust = Customer::orderBy('email','desc')->paginate(20);
    // $models = DeviceBrand::orderBy('brand_name','desc')->paginate(2);
       return view('customers.index')->with('cust',$cust);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $request->user()->authorizeRoles(['admin', 'prodavac']);
        return view('customers.create');
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
            'surname' => 'required_without:ico|max:80',
            'street' => 'required|max:80',
            'house_num' => 'required|numeric|max:10000',
            'ico' => 'nullable|numeric|max:8',
            'city' => 'required|max:80',
            'post_code' => 'required|regex:/\d{5}/',
            'phone_num' => 'required|regex:/\d{9}/',
            'email' => 'required|email',
        ]);

        //create post
        $cust = new Customer;
        $cust->ico = $request->input('ico');
        
        $cust->name = $request->input('name');
        
        $cust->surname = $request->input('surname');
        $cust->street = $request->input('street');
        $cust->house_num = $request->input('house_num');
        $cust->city = $request->input('city');
        $cust->post_code = $request->input('post_code');
        $cust->phone_num = $request->input('phone_num');
        $cust->email = $request->input('email');
        $cust->save();  

        
        return redirect('/customers')->with('success', 'Zakazník uložen!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cust = Customer::find($id);
        return view('customers.show')->with('cust',$cust);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {   
        $request->user()->authorizeRoles(['admin', 'prodavac']);
        $cust = Customer::find($id);
        return view('customers.edit')->with('cust',$cust);
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
        $request->user()->authorizeRoles(['admin', 'prodavac']);
        $this->validate($request,[
            'name' => 'required|max:80',
            'surname' => 'required_without:ico|max:80',
            'street' => 'required|max:80',
            'house_num' => 'required|numeric|max:10000',
            'ico' => 'nullable|numeric|max:8',
            'city' => 'required|max:80',
            'post_code' => 'required|regex:/\d{5}/',
            'phone_num' => 'required|regex:/\d{9}/',
            'email' => 'required|email',
        ]);

        //create post
        $cust = Customer::find($id);
        $cust->ico = $request->input('ico');
        
        $cust->name = $request->input('name');
        
        $cust->surname = $request->input('surname');
        $cust->street = $request->input('street');
        $cust->house_num = $request->input('house_num');
        $cust->city = $request->input('city');
        $cust->post_code = $request->input('post_code');
        $cust->phone_num = $request->input('phone_num');
        $cust->email = $request->input('email');
        $cust->save();  

        
        return redirect('/customers')->with('success', 'Zakazník uložen!'); 
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
        $order = DB::table('orders')
        ->where('cus_id', $id)->get();
        //return $order;
        
        if ($order == '[]') {
            $cus = Customer::find($id);
            $cus->delete();
            return redirect('/customers')->with('success', 'Zákazník vymazán!');
        }else{
            return redirect('/customers/'.$id)->with('error', 'Zákazník je vázan k nějaké zakázce, nelze vymazat!');
        }
        
    }
    
}
