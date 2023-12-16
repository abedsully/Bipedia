<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Article;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function view(){
        return view('main.login');
    }

    public function authenticate(Request $request){
        $user = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($user)){
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->with('loginError', 'Login Failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('login');
    }

    public function showProfile($id){
        $user = User::findOrFail($id);

        if (Auth::user()->id === $user->id) {
            return view('profile.profile', compact('user'));
        } else {
            return back()->with('error', 'Forbidden behavior');
        }
    }

    public function showProfileAdmin($id) {
        $user = User::findorFail($id);
        return view('profile.profile', compact('user'));
    }

    public function deleteUser($id) {

        Article::where('user_id', $id)->delete();

        User::destroy($id);

        return redirect('/user-lists')->with('success', 'User has been deleted successfully!');
    }

    public function editProfile($id) {
        $user = User::findOrFail($id);
        return view('profile.editProfile', compact('user'));
    }

    public function updateProfile(Request $request, $id) {

        $user = User::findOrFail($id);
    
        $validasi = $request->validate([
            'name' => 'required',
            'username' => ['required', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email:dns', Rule::unique('users')->ignore($user->id)],
            'phone' => 'required|numeric|digits: 10',
            'address' => 'required',
        ]);
    
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
    
        return redirect('/my-profile/' . $id)->with('success', 'Profile has been updated successfully');
    }

}
