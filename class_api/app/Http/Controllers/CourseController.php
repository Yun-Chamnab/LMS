<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseController extends Controller
{

    public function index()
    {
        $course = Course::all();
        return $this->successResponse($course);
    }

    public function courseStudent($course)
    {
        // $exam = Student::where('student_id', $course)->get('class_id');
        $exam = Student::where('student_id', $course)->get('class_id');
        $result = null;

        foreach ($exam as $key) {
            if ($key->class_id) {

                $result[] = Course::where('class_id', $key->class_id)->get();
            }
        }
        return $this->successResponse($result);
    }

    public function countLesson()
    {
        $course1 = Course::all();
        $lesson = Lesson::all()->count();
        // // $exam1 = Exam::where('publish', 1)->get()->count();
        // return $this->successResponse($course);

        $course = Course::with('lesson')->get();
        return $this->successResponse(["course" => $course1, "this" => $lesson]);
    }


    public function show($course)
    {
        // $course_id = $this->findUOrFail($course);
        $course = Course::where('class_id', $course)->get();
        return $this->successResponse($course);
    }

    public function store(Request $request)
    {
        // $rules = [
        //     'user_id' => 'required|max:255',
        // ];

        // $this->validate($request, $rules);
        $data = new Course;
        $data->class_id = $request->class_id;
        $data->teacher_id = $request->teacher_id;
        $data->teacher_name = $request->teacher_name;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->image_path = $request->image_path;
        if ($request->hasfile('image_path')) {
            $file = $request->file('image_path');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . $extension;
            $file->move('uploads/course_img/', $filename);
            $data->image_path = $filename;
        }
        $data->save();
        // $data = Course::create($request->all());

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
