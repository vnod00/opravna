<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeviceModel;
use App\DeviceBrand;
use DB;

class DeviceModelController extends Controller
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
      
      $models = DeviceModel::orderBy('model_name','desc')->paginate(2);
       return view('models.index')->with('models',$models);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('models.create');
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
        $device = new DeviceModel;
        $device->model_name = $request->input('model');
        $device->imei = $request->input('imei');
        $device->brand_id  = DB::table('device_brands')
        ->where('brand_name', "{$request->input('brand_name')}")->value('brand_id');
        $device->save(); 
        
        
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
        $model = DeviceModel::find($id);
        return view('models.show')->with('model', $model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = DeviceModel::find($id);
        return view('models.edit')->with('model', $model);
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
            'model' => 'required',
            'imei' => 'required',
            'brand_name' => 'required'
        ]);
        //create post
        $device = DeviceModel::find($id);
        $device->model_name = $request->input('model');
        $device->imei = $request->input('imei');
        $device->brand_id  = DB::table('device_brands')
        ->where('brand_name', "{$request->input('brand_name')}")->value('brand_id');
        $device->save(); 
        
        
        return redirect('/models')->with('success', 'Telefon editován!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = DeviceModel::find($id);
        $model->delete();
        return redirect('/models')->with('success', 'Telefon vymazán!');
    }
    
    function fetch(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');
      $data = DB::table('device_brands')
        ->where('brand_name', 'LIKE', "{$query}%")
        ->get();
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '
       <li><a href="#">'.$row->brand_name.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }
}
