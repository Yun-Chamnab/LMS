<?php

namespace App\Http\Controllers;

use App\Models\Student;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{

    public function index()
    {
        $student = Student::all();
        return $this->successResponse($student);
    }

    // public function indexStudent()
    // {
    //     $exam = Exam::where('publish', '1')->get();
    //     return $this->successResponse($exam);
    // }

    // public function countExam()
    // {
    //     $exam = Exam::all()->count();
    //     $exam1 = Exam::where('publish', 1)->get()->count();
    //     return $this->successResponse(["allExam" => $exam, "examPublish" => $exam1]);
    // }

    public function show($student)
    {
        $student = Student::find($student);
        return $this->successResponse($student);
    }

    public function store(Request $request)
    {
        
        $invite = $request->json()->all();

        foreach ($invite as $inv){
            $data=Student::create($inv);
        }

        return $this->successResponse($data);
    }

    public function update(Request $request, $student)
    {
        // $rules = [
        //     'class_name' => 'max:255',
        // ];

        // $this->validate($request, $rules);
        $student = Student::findOrFail($student);
        $student = $student->fill($request->all());

        if ($student->isClean()) {
            return $this->errorResponse(
                'at least one value must be change',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $student->save();
        return $this->successResponse($student);
    }


    public function destroy($student)
    {

        $student = Student::findOrFail($student);
        $student->delete();
        return $this->successResponse($student);
    }
}
