<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

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
     $cust = Customer::orderBy('surname','desc')->paginate(20);
    // $models = DeviceBrand::orderBy('brand_name','desc')->paginate(2);
       return view('customers.index')->with('cust',$cust);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $this->validate($request,[
            'name' => 'required',
            'surname' => 'required',
            'street' => 'required',
            'house_num' => 'required',
            'city' => 'required',
            'post_code' => 'required',
            'phone_num' => 'required',
            'email' => 'required',
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
       //
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
    
}
