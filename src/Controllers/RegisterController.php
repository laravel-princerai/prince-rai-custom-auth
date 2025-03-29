<?php

namespace PrinceRai\CustomAuth\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

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
            $user = new User();
            $data = $user->storeData($request);

            return [
                'status' => true,
                'message' => "Registered successfully please Login",
                'redirect' => route('login')
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
