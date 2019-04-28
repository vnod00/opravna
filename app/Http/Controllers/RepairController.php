<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repair;
use DB;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return $models = DeviceBrand::with('model')->get();
      // $models = DeviceBrand::find(2)->model;
      
      $repairs = Repair::orderBy('model_name','desc')->paginate(2);
       return view('repairs.index')->with('repairs',$repairs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('repairs.create');
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
            'descp' => 'required',
            'price' => 'required'
        ]);
        //create post
        $repair = new Repair;
        $repair->name = $request->input('name');
        $repair->descp = $request->input('descp');
        $repair->price  = $request->input('price');
        $repair->save(); 
        
        
        return redirect('/repairs')->with('success', 'Oprava uložena!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Repair::find($id);
        return view('repairs.show')->with('model', $model);
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
