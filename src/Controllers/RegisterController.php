<?php

namespace PrinceRai\CustomAuth\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('custom-auth::register');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return array
     */
    public function register(Request $request)
    {
        try {
            $existingUser = User::where('email', $request->email)->first();

            if ($existingUser) {
                return [
                    'status' => false,
                    'message' => "Email already registered"
                ];
            }

            // Manually creating the user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return [
                'status' => true,
                'message' => "Registered successfully. Please login.",
                'redirect' => route('login')
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
