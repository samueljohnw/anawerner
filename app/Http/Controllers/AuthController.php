<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\LoginLink;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    function attempt(Request $request) {
        
        $request->validate([
            'email' => 'required|email',
        ]);
        
        // if user exists proceed, otherwise check for spam and create user.
        $user = User::where('email', $request->email)->first();

        if(!$user){
            
            $this->honeypot($request);

            $user = new User;
            $user->name = ' ';
            $user->email = $request->email;
            $user->save();
        }

        // Generate and store token with expiration time
        $token = Str::random(56);
        $user->login_token = hash('sha256', $token);
        $user->login_token_expires_at = Carbon::now()->addMinutes(15);
        $user->save();

        // Send login link email with token
        Mail::to($user)->send(new LoginLink($user, $token));

        return back()->withErrors([
            'email' => 'If this email exists, a login link has been sent.',
        ])->withInput();
 
    }

    function login(Request $request) {
        $user = User::where('login_token', $request->token)->first();

        if ($user && $user->login_token_expires_at && $user->login_token_expires_at->isFuture()) {
            Auth::loginUsingId($user->id);
            $request->session()->regenerate();

            // Clear token after login
            $user->login_token = null;
            $user->login_token_expires_at = null;
            $user->email_verified = true;
            $user->save();

            return redirect()->intended('training');   
        }
        
        return back()->withErrors(['token' => 'Invalid or expired token.']);   
    }

    public function logout(Request $request)
    {
        // Log the user out of the application
        Auth::logout();

        // Invalidate the user's session to prevent reuse
        $request->session()->invalidate();

        // Regenerate the session token to prevent CSRF attacks
        $request->session()->regenerateToken();

        // Redirect the user to the login page or home page
        return redirect('/');
    }

    function honeypot($inputBox) {

        if($inputBox->filled('weetard')){
            return abort(422,'Spam Detected');
        }
        return;
    }
}
