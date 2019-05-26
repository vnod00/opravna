<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeviceModel;
use App\DeviceBrand;
use DB;

class DeviceModelController extends Controller
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
      
        $models = DeviceModel::orderBy('model_name','desc')->paginate(10);
        return view('models.index')->with('models',$models);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'prodavac']);
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
        $request->user()->authorizeRoles(['admin', 'prodavac']);
        $this->validate($request,[
            'model' => 'required|max:80',
            'imei' => 'required|regex:/\d{15}/|unique:device_models,imei',
            'brand_name' => 'required|exists:device_brands,brand_name',
            'cover_image' => 'image|required|max:1999'
        ]);
        if ($request->hasFile('cover_image')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images/', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        
        //create post
        $device = new DeviceModel;
        $device->cover_image = $fileNameToStore;
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin', 'prodavac']);
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
        $request->user()->authorizeRoles(['admin', 'prodavac']);
        $this->validate($request,[
            'model' => 'required|max:80',
            'imei' => 'required|regex:/\d{15}/|unique:device_models,imei,'.$id,
            'brand_name' => 'required|exists:device_brands,brand_name',
            'cover_image' => 'image|required|max:1999'
            ]);
        if ($request->hasFile('cover_image')) {
                // Get filename with the extension
                $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= time().'.'.$extension;
                // Upload Image
                $path = $request->file('cover_image')->storeAs('public/cover_images/', $fileNameToStore);
        }
        //create post
        $device = DeviceModel::find($id);
        $device->cover_image = $fileNameToStore;
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
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles(['admin', 'prodavac']);
        $order = DB::table('orders')
        ->where('model_id', $id)->pluck('model_id');
        if ($order == []) {
            $model = DeviceModel::find($id);
            $model->delete();
            return redirect('/models')->with('success', 'Telefon vymazán!');
        }
        return redirect('/models')->with('error', 'Model je vázan k nějaké zakázce, nelze vymazat!');
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
