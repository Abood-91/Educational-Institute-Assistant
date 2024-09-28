<?php

namespace Modules\StudentManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\StudentManagement\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle registration of a new student.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:students,email',
            'phone_number' => 'required|string|max:15',
            'enrollment_date' => 'required|date',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create the student
        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'enrollment_date' => $request->enrollment_date,
            'password' => Hash::make($request->password),
        ]);

        $token = $student->createToken('Student Token')->accessToken;

        return response()->json(['student' => $student, 'token' => $token], 201);
    }
   /* This is not for deleting **************************************************/
    /**
     * Handle login of a student.
        */
    // public function login(Request $request)
    // {
    //     // Validate the incoming request
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $student = Auth::user();
    //         $token = $student->createToken('Student Token')->accessToken;

    //         return response()->json(['student' => $student, 'token' => $token], 200);
    //     }

    //     return response()->json(['error' => 'Unauthorized'], 401);
    // }

    /**
     * Handle logout of a student.
     */
    public function logout(Request $request)
    {
        if (Auth::check()) {
            $request->user()->token()->revoke();

            return response()->json(['message' => 'Successfully logged out'], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
