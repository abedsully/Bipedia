<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
    public function view(){
        return view('main.register');
    }

    public function store(Request $request){
        $validasi = $request->validate([
            'name' => 'required|min:3|max:40',
            'username' => 'required|unique:users|min:5|max:10',
            'email' => 'required|unique:users|email:dns',
            'gender' => 'required',
            'password' => 'required|min:8|max:12|',
            'confirm' => 'required|same:password',
            'phone' => 'required|numeric|digits: 10',
            'address' => 'required',
            'birthday' => 'required'
        ]);
        

        $validasi['password'] = bcrypt($validasi['password']);
        $validasi['confirm'] = bcrypt($validasi['confirm']);
        User::create($validasi);
        return redirect('/login')->with('success', 'Account created successfully!');
    }

    public function storePicture(Request $request, $id) {

        $validasi = $request->validate([
            'profile_picture' => 'required'
        ]);

        $filename = NULL;
    
        if ($request->file('profile_picture') != NULL) {
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            $originalName = pathinfo($request->file('profile_picture')->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = $originalName . '_' . $extension;
            $request->file('profile_picture')->storeAs('/public/profile', $filename);
        }
    
        User::findOrFail($id)->update([
            'profile_picture' => $filename
        ]);
    
        return redirect('/my-profile/' . $id)->with('success', 'Profile picture updated successfully!');
    }

    public function showUser(){
        $users = User::all();

        return view('profile.userList', compact('users'));
    }
    
}
