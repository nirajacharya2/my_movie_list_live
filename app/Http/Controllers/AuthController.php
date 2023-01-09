<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\AuthController;

class AuthController extends Controller
{

    function logout()
    {
        // Auth::logout();
        if (session()->has('userInfo')) {
            session()->pull('userInfo');
            return redirect('login');
        }
    }


    function login(Request $request)
    {
        // return ($request->input());

        $data = $request->validate([
            'username' => ['required', 'min:6', 'max:64'],
            'password' => ['required', 'min:6', 'max:64'],
        ]);


        $data = $request->only('username', 'password');
        $userInfo = User::where('username', '=', $data['username'])->first();
        if ($userInfo) {
            if (Hash::check($data['password'], $userInfo->password)) {
                session()->put('userInfo', $userInfo);
                return redirect('/');
            } else {
                return back()->with('fail', "Login failed. wrong password");
            }
        } else {
            return back()->with('fail', "Login failed. no such user");
        }
    }

    function signup(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username|min:6|max:64|regex:/^[A-Za-z0-9 ]+$/',
            'email' => 'required|unique:users,email',
            'sex' => 'required|boolean',
            'password' => 'min:6|max:128|required',
            'confirmpassword' => 'min:6|max:128|required|same:password',
            'dob' => 'required|date',
        ]);
        $data = $request->all();
        $user = new User();
        $user->username = $data['username'];
        $user->user_sex = $data['sex'];
        $user->user_dob = $data['dob'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $query = $user->save();

        if ($query) {
            return back()->with('success', "You have been successfuly registered");
        } else {
            return back()->with('fail', "Something went wrong");
        }
    }



    // email verification signup and login


    // function login(Request $request)
    // {
    //     // return ($request->input());

    //     $data = $request->validate([
    //         'username' => ['required', 'min:6', 'max:64'
    //         ],
    //         'password' => ['required', 'min:6', 'max:64'
    //         ],
    //     ]);


    //     // $data = $request->only('username', 'password');
    //     // dd($data);
    //     // dd(Auth::attempt($data));


    //     // if (Auth::guard('users')->attempt($data)) {
    //     //     $request->session()->regenerate();
    //     //     Session::put('userid', 1);
    //     //     return redirect()->route('/')->with('success', "Login success");
    //     // } else {
    //     //     return back()->with('fail', "Login failed");
    //     // }
    //     $userInfo = User::where(
    //         'username',
    //         '=',
    //         $data['username']
    //     )->first();

    //     if (!$userInfo) {
    //         return back()->with('fail', "Login failed. no such user");
    //     } else {

    //         if (User::where('username', '=', $data['username'])->where('email_verified_at', '=', null)->first()) {
    //             return back()->with('fail', "Email Not verified")->with('data', $data['username']);
    //         }

    //         if (Hash::check($data['password'], $userInfo->password)) {
    //             session()->put('userInfo', $userInfo);
    //             return redirect('/');
    //         } else {
    //             return back()->with('fail', "Login failed. wrong password");
    //         }
    //     }
    // }



    // function signup(Request $request)
    // {
    //     // return ($request->input());
    //     $request->validate([
    //         'username' => 'required|unique:users,username|min:6|max:64',
    //         'email' => 'required|unique:users,email',
    //         'sex' => 'required|boolean',
    //         'password' => 'min:6|max:128|required',
    //         'confirmpassword' => 'min:6|max:128|required|same:password',
    //         'dob' => 'required|date',
    //     ]);
    //     $data = $request->all();

    //     // User::created($data);
    //     $token = Str::random(64);

    //     try {
    //         $user = new User();
    //         $user->username = $data['username'];
    //         $user->user_sex = $data['sex'];
    //         $user->user_dob = $data['dob'];
    //         $user->email = $data['email'];
    //         $user->remember_token = $token;
    //         $user->password = Hash::make($data['password']);
    //         $user->save();



    //         $action_link = route('confirmverifyEmail', ['token' => $token, 'email' => $request->email]);
    //         $body = "Please click the link below to verify your <b>My Movie List</b> account associated with email " . $request->email . "clicking the link below";

    //         Mail::send(
    //             'verify-email',
    //             ['action_link' => $action_link, 'body' => $body],
    //             function ($message) use ($request) {
    //                 $message->from('noreply@example.com', 'My Movie List');
    //                 $message->to($request->email, 'Your Name')->subject('Verify Email');
    //             }
    //         );
    //         return back()->with('success', 'Check your mail to verify your account');
    //     } catch (Exception $e) {
    //         return back()->with('fail', "operation failed" . $e);
    //     }
    // }
    // function reVerify(Request $request)
    // {
    //     // return ($request->input());
    //     $request->validate([
    //         'username' => [
    //             'required', 'min:6', 'max:64'
    //         ],
    //     ]);

    //     // User::created($data);
    //     $mail = User::where('username', $request->username)->get();
    //     $token = Str::random(64);
    //     try {
    //         $action_link = route('confirmverifyEmail', ['token' => $token, 'email' => $mail[0]->email]);
    //         $body = "Please click the link below to verify your <b>My Movie List</b> account associated with email " . $request->email . "clicking the link below";

    //         Mail::send(
    //             'verify-email',
    //             ['action_link' => $action_link, 'body' => $body],
    //             function ($message) use ($mail) {
    //                 $message->from('noreply@example.com', 'My Movie List');
    //                 $message->to($mail[0]->email, 'Your Name')->subject('Verify Email');
    //             }
    //         );
    //         return back()->with('success', 'Regestration Completed, check your mail to verify your account');
    //     } catch (Exception $e) {
    //         return back()->with('fail', "operation failed" . $e);
    //     }
    // }
    // function confirmverifyEmail($token, $email)
    // {
    //     return view('confirmVerification')->with('token', $token)->with('email', $email);
    // }
    // function verifyEmail(Request $request)
    // {
    //     $check_token = DB::table('users')
    //         ->where('email', $request->email)
    //         ->where('remember_token', $request->token);
    //     // dd($request->input());
    //     if (!$check_token) {
    //         return back()->with('fail', 'Invalid Token');
    //     } else {
    //         User::where('email', $request->email)->update([
    //             'email_verified_at' => Carbon::now()
    //         ]);
    //         DB::table('users')->where('email', $request->email)->update(['remember_token' => null]);
    //         return redirect()->route('login')->with('success', "Email has been Verified");
    //     }
    // }





}