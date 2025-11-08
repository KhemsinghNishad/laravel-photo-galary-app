<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function logout(Request $request){
        Auth::logout();        
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }

    public function registerProcess(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|unique:users,user_id',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->only(['name', 'email', 'phone', 'user_id', 'address']));
        }

        User::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
    }


    public function login()
    {
        return view('auth.login');
    }

    public function loginProcess(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'password' => 'required'
        ]);
        
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        if(Auth::attempt(['user_id' => $request->user_id, 'password' => $request->password])){
            $request->session()->flash('success', 'Login successful!');
            return response()->json([
                'status' => true,
                'message' => 'Login successful!'
            ]);
        } else {
            $request->session()->flash('error', 'Invalid credentials, either email or password incorrect');
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials, either email or password incorrect'
            ]);
        }
    } 
}
