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

    public function show($student)
    {
        $student = Student::find($student);
        return $this->successResponse($student);
    }

    public function store(Request $request)
    {
        // $rules = [
        //     'user_id' => 'required|max:255',
        // ];

        // $this->validate($request, $rules);
        $data = new Student;
        $data->class_id = $request->class_id;
        foreach ($request->student_id as $key) {
            $data->student_id = $key;
            $data->student_name = $key;
        }
        $data->save();
       

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
