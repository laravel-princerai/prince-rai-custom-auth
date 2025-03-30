<?php

namespace PrinceRai\CustomAuth\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController
{
    /**
     * Display the login page.
     */
    public function index()
    {
        return view('custom-auth::login');
    }

    /**
     * Handle authentication.
     */
    public function authLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        try {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json(['status' => false, 'message' => "Email Address Not Found"]);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json(['status' => false, 'message' => "Incorrect Password"]);
            }

            Auth::login($user);
            $request->session()->regenerate();

            return response()->json([
                'status' => true,
                'message' => "Login Successfully",
                'redirect' => route('home')
            ]);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
    public function home()
    {
        return view('custom-auth::after-login');

    }
}
