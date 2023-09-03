<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // Import the Request class
use Illuminate\Support\Facades\Validator;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:11',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        } else {
            // Replace 'Student::create' with 'Product::create' if you are creating a product
            $students = Student::create([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            if ($students) {
                return response()->json([
                    'status' => 201, // Use 201 Created for successful resource creation
                    'message' => 'Product created successfully',
                    'data' => $students, // Optionally, you can include the created product in the response
                ], 201);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong',
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        $student = Student::find($id);
    
        if ($student) {
            return response()->json([
                'status' => 200,
                'student' => $student
            ], 200);
        }
    
        return response()->json([
            'status' => 404,
            'message' => 'Student not found'
         
        ],404);
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'status' => 404,
                'message' => 'No such Student found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:11',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422); 
        }

        $student->update([
            'name' => $request->name,
            'course' => $request->course,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Student updated successfully',
            'student' => $student,
        ], 200);
    }
    /**
     * Remove the specified resource from storage.
     */
     
    public function destroy($id)
    {
        $student = Student::find($id);
    
        if (!$student) {
            return response()->json([
                'status' => 404,
                'message' => 'Student not found',
            ], 404);
        }
    
        $student->delete();
    
        return response()->json([
            'status' => 200,
            'message' => 'Student deleted successfully',
        ], 200);
    }
}