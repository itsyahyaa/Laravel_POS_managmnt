<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::paginate(5);
        return view('users', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // form is not validated point to note
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = md5($request->password);
        $user->is_admin = $request->is_admin;
        $user->save();
        if($user){
            return redirect()->back()->with('User Created');
        }
        return redirect()->back()->with('User Fail Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,$id)
    {
        //
        $users = User::find($id);
        if(!$users){
            return back()->with('Error','User NOT found');
        }
        $users->update($request->all());
        return back()->with('Success','User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $users = User::find($id);
        if(!$users){
            return back()->with('Error','User NOT found');
        }
        $users->delete();
        return back()->with('Success','User Deleted Successfully');
    }

}
