<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if(!$user)
            return back()->withErrors(['email or password is incorrect']);
        if(Hash::check($request->password,$user->password)){
            auth()->login($user);
            return response()->redirectTo('/');
        }
        return back()->withErrors(['email or password is incorrect']);
    }

    public function logout()
    {
        auth()->logout();
        return response()->redirectToRoute('login');
    }
}
