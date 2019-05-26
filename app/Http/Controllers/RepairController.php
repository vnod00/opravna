<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repair;
use DB;

class RepairController extends Controller
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
      // $models = DeviceBrand::find(2)->model;
      
      $repairs = Repair::orderBy('name','desc')->paginate(2);
       return view('repairs.index')->with('repairs',$repairs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles('admin');
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
        $request->user()->authorizeRoles('admin');
        $this->validate($request,[
            'name' => 'required|max:80',
            'descp' => 'required|max:2000',
            'price' => 'required|numeric|max:100000'
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin', 'opravar']);
        $repair = Repair::find($id);
        return view('repairs.edit')->with('repair', $repair);
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
        $request->user()->authorizeRoles(['admin', 'opravar']);
        $this->validate($request,[
            'name' => 'required|max:80',
            'descp' => 'required|max:2000',
            'price' => 'required|numeric|max:100000'
        ]);
        //create post
        $repair = Repair::find($id);
        $repair->name = $request->input('name');
        $repair->descp = $request->input('descp');
        $repair->price  = $request->input('price');
        $repair->save(); 
        
        
        return redirect('/repairs')->with('success', 'Oprava uložena!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles('admin');
        $repair = Repair::find($id);
        $check = DB::table('order_repair')
        ->where('rep_id', '=', $repair->rep_id)
        ->get(); 
        if ($check = '[]') {
            $repair->delete();
            return redirect('/repairs')->with('success', 'Oprava vymazána!');
        }else{
            return redirect('/repairs')->with('error', 'Oprava nelze vymazat, je vázaná z nějaké zakázce!');
        }      
    }
    
}
