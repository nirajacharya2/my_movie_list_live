<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    function sendresetmail(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);
        // dd($data);
        $token = Str::random(64);
        // dd($token);
        DB::table('password_resets')->insert([
            'email' => $data['email'],
            'token' => $token,
            'created_at' => Carbon::now()
        ]);


        $action_link = route('forgotpassword', ['token' => $token, 'email' => $data['email']]);
        $body = "We have recived a request to reset the password for <b>My Movie List</b> account associated with " . $request->email . " You can reset your password by clicking the link below";

        Mail::send(
            'email-forgot',
            ['action_link' => $action_link, 'body' => $body],
            function ($message) use ($request) {
                $message->from('noreply@example.com', 'My Movie List');
                $message->to($request->email, 'Your Name')->subject('Reset Password');
            }
        );
        return back()->with('success', 'we have e-mailed you your password reset link if you didnt get it try again');
    }
    function forgotpasswordForm(Request $request, $token = null)
    {
        return view('forgotpassword')
            ->with('token', $token)
            ->with('email', $request->email);
    }
    function passwordresetconformation(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => 'min:6|max:128|required',
            'confirmpassword' => 'min:6|max:128|required|same:password',
        ]);
        // dd($request->token, $request->email);
        $check_token = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token);
        // dd($request->input());
        if (!$check_token) {
            return back()->with('fail', 'Invalid Token');
        } else {
            User::where('email', $request->email)->update([
                'password' => Hash::make($request->password)
            ]);
            DB::table('password_resets')->where('email', $request->email)->delete();
            return redirect()->route('login')->with('success', "Password has been changed");
        }
    }
}