<?php

namespace App\Http\Controllers;

use App\Models\Course;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseController extends Controller
{

    public function index()
    {
        $course = Course::all();
        return $this->successResponse($course);
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

    public function show($course)
    {
        $course = Course::find($course);
        return $this->successResponse($course);
    }

    public function store(Request $request)
    {
        // $rules = [
        //     'user_id' => 'required|max:255',
        // ];

        // $this->validate($request, $rules);
        $data = Course::create($request->all());

        return $this->successResponse($data);
    }

    public function update(Request $request, $course)
    {
        // $rules = [
        //     'class_name' => 'max:255',
        // ];

        // $this->validate($request, $rules);
        $course = Course::findOrFail($course);
        $course = $course->fill($request->all());

        if ($course->isClean()) {
            return $this->errorResponse(
                'at least one value must be change',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $course->save();
        return $this->successResponse($course);
    }


    public function destroy($course)
    {

        $course = Course::findOrFail($course);
        $course->delete();
        return $this->successResponse($course);
    }
}
