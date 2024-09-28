<?php

namespace Modules\StudentManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\StudentManagement\Models\Student;
use Modules\StudentManagement\Services\StudentService;

class StudentController extends Controller
{

    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json($students);    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('studentmanagement::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:students,email',
            'phone_number' => 'required|string|max:15',
            'enrollment_date' => 'required|date',
            'password' => 'required|string|min:8',
        ]);

        $student = Student::create($validatedData);
        return response()->json($student, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $student = $this->studentService->getStudentDetails($id);
        return response()->json($student);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('studentmanagement::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|unique:students,email,' . $id,
            'phone_number' => 'sometimes|required|string|max:15',
            'enrollment_date' => 'sometimes|required|date',
            'password' => 'sometimes|required|string|min:8',
        ]);

        $student->update($validatedData);
        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return response()->json(null, 204);
    }
}
