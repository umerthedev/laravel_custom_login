<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    //login
    public function index()
    {
        return view('auth.login');
    }
    public function user_login(Request $request)
    {
        // dd($request->all());
         $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // $credentials = $request->only('email', 'password');
        // if (auth()->attempt($credentials)) {
        //     return redirect()->intended('home')
        //         ->withSuccess('Signed in');
        // }
        if(\Auth::attempt($request->only('email','password'))){
            return redirect('home');
        }
        return back()->with('message','Invalid login details');

        
    }

    public function register_view()
    {
        return view('auth.registration');
    }
    public function user_reg(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        user::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>\Hash::make($request->password)
            
            
        ]);
        if(\Auth::attempt($request->only('email','password'))){
            return redirect('home');
        }
        return back()->with('messege','Invalid login details');
        
        
    }
    //home
    public function home()
    {
        return view('home');
    }
    //logout
    public function logout()
    {
        // \Session::flsuh();
        \Auth::logout();
        return redirect('login');
    }
}
