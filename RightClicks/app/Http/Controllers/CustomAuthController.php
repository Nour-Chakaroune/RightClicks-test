<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomAuthController extends Controller
{


    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'role' => 'required',
        ],
    [
        'name.required'=>'Please enter username',
        'password.required'=>'Please enter your password',
        'role.required'=>'Please select your role'
    ]
    );

        if (Auth::attempt(['name'=>$request->name,'password'=>$request->password,'role'=>$request->role])) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }

        else{
        return back()->withErrors('Login details are not valid');
    }
}
    public function dashboard()
    {
            return view('Admin.dashboard');
      }

    public function signOut() {
        Auth::logout();

        return Redirect('login');
    }
}
