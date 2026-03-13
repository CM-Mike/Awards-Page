<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    // Show all users
    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::when($search, function ($query) use ($search) {
                $query->where('name','like',"%$search%")
                      ->orWhere('email','like',"%$search%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.users.index', compact('users','search'));
    }


    // Show create form
    public function create()
    {
        return view('admin.users.create');
    }


    // Store new user
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        return redirect()->route('admin.users')
            ->with('success','User created successfully');
    }


    // Edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }


    // Update user
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $request->validate([
            'name'=>'required',
            'email'=>'required|email'
        ]);

        $user->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);

        return redirect()->route('admin.users')
            ->with('success','User updated successfully');
    }


    // Delete user
    public function destroy($id)
    {

        $user = User::findOrFail($id);

        $user->delete();

        return back()->with('success','User deleted');

    }

}