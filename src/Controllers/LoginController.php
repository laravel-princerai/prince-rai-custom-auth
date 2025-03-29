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
        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return [
                    'status' => false,
                    'message' => "Email Address Not Found"
                ];
            }
            if (!Hash::check($request->password, $user->password)) {
                return [
                    'status' => false,
                    'message' => "Incorrect Password"
                ];
            }

            // Removed `status` column check

            Auth::login($user);
            $route = ($user->roleSlug === 'admin') ? route('admin.dashboard') : route('home');

            return [
                'status' => true,
                'message' => "Login Successfully",
                'redirect' => $route
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
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
}
