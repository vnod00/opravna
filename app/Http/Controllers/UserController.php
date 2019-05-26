<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use DB;
class UserController extends Controller
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
      
      $users = User::orderBy('id','desc')->paginate(20);
    
       return view('users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        $request->user()->authorizeRoles('admin');
        $user = User::find($id);
        return view('users.edit')->with('user', $user);
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
        $request->user()->authorizeRoles('admin');
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'role_name' => 'required', 'exists:roles,name'
        ]);
        $role_id = DB::table('roles')
        ->where('name', "{$request->input('role_name')}")->value('role_id');
        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->role_id = $role_id;
        $user->save();
        return redirect('/users')->with('success', 'Uživatel upraven');
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
        $order = DB::table('task_done')
        ->where('user_id', $id)->pluck('user_id');
        if ($order == '[]') {
            $user = User::find($id);
            $user->delete();
            return redirect('/users')->with('success', 'Uživatel vymazán!');
        } else {
            return redirect('/users')->with('error', 'Uživatel je vázan k nějaké zakázce, nelze vymazat!');
        }
       
    }
    
}
