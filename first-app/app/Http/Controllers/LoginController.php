<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\welcomeEmail;
use Illuminate\Support\Facades\Mail;


class LoginController extends Controller
{

    public function index(Request $request)
    {
        return view("login");
    }
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required",
        ]);
        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $otpgenrate = rand(111111, 999999);
                session(['otp' => $otpgenrate]);
                try {
                    $to = Auth::user()->email;
                    $msg = $otpgenrate;
                    $subject = "Code with laravel";
                    Mail::to($to)->send(new welcomeEmail($msg, $subject));
                    return redirect()->route('account.otp')->with('success', 'Email and password is successfully');
                } catch (\Throwable $th) {
                    return $th;
                }
            } else {
                return redirect()->route('account.login')->with('error', 'Either email and password is incorrect');
            }
        } else {
            return redirect()->route('account.login')
                ->withInput()
                ->withErrors($validator);
        }
    }

    public function register(Request $request)
    {
        return view('register');
    }
    public function registerdata(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email|unique:users",
            "name" => "required",
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);
        if ($validator->passes()) {

            $userdata = new User();
            $userdata->name = $request->name;
            $userdata->email = $request->email;
            $userdata->password = Hash::make($request->password);
            $userdata->role = 'customer';
            $userdata->save();
            return redirect()->route('account.login')->with('success', 'register data successfully ');
        } else {
            return redirect()->route('account.register')
                ->withInput()
                ->withErrors($validator);
        }
    }
    public function OTPView()
    {
        return view('otpview');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }
}
