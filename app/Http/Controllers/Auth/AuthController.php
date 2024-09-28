<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Admin credentials
    private $adminEmail = 'admin@gmail.com';
    private $adminPassword = 'saveyourtearsforanotherday';


    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     // Check if it's the admin
    //     if ($credentials['email'] === $this->adminEmail && $credentials['password'] === $this->adminPassword) {
    //         // Log in as admin
    //         $admin = User::where('email', $this->adminEmail)->first();
    //         $token = $admin->createToken('admin-token')->plainTextToken;

    //         return response()->json([
    //             'message' => 'Logged in as admin',
    //             'token' => $token,
    //             'role' => 'admin',
    //         ]);
    //     }

    //     // authenticate as a student
    //     if (Auth::attempt($credentials)) {
    //         $student = Auth::user();
    //         $token = $student->createToken('student-token')->plainTextToken;

    //         return response()->json([
    //             'message' => 'Logged in as student',
    //             'token' => $token,
    //             'role' => 'student',
    //         ]);
    //     }

    //     return response()->json(['error' => 'Unauthorized'], 401);
    // }

    // // Registration function (for students)
    // public function register(Request $request)
    // {

    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);


    //     $student = User::create([
    //         'name' => $validated['name'],
    //         'email' => $validated['email'],
    //         'password' => bcrypt($validated['password']),
    //     ]);

    //     return response()->json(['message' => 'Student registered successfully']);
    // }


    // public function logout(Request $request)
    // {
    //     $request->user()->tokens()->delete();
    //     return response()->json(['message' => 'Logged out successfully']);
    // }
}
