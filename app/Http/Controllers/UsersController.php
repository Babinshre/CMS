<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {

        return view('users.index')->with('users',User::all());
    }
    public function makeAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();
        session()->flash('success','User is made admin successfully');
        return redirect()->back();
    }
    public function edit()
    {
        return view('users.edit')->with('user',auth()->user());
    }
    public function update(Request $request)
    {
        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'about' => $request->about,
            
        ]);
        dd($user->about);
        session()->flash('success','Profile updated successfully');
        return redirect()->back();
    }
}
