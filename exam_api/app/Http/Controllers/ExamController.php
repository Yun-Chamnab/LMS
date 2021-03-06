<?php

namespace App\Http\Controllers;

use App\Models\Exam;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExamController extends Controller
{

    public function index()
    {
        $exam = Exam::all();
        return $this->successResponse($exam);
    }

    public function indexStudent($exam)
    {
        $exam = Exam::where('publish', '1')->where('course_id', $exam)->orderBy('created_at', 'desc')->get();
        return $this->successResponse($exam);
    }

    public function countExam()
    {
        $exam = Exam::all()->count();
        $exam1 = Exam::where('publish', 1)->get()->count();
        return $this->successResponse(["allExam" => $exam, "examPublish" => $exam1]);
    }

    public function show($exam)
    {
        $exam = Exam::where('course_id', $exam)->get();
        return $this->successResponse($exam);
    }

    public function store(Request $request)
    {
        $rules = [
            'course_id' => 'required',
            'name' => 'required|max:255',
            'duration' => 'required|max:20',
        ];

        $this->validate($request, $rules);
        $data = Exam::create($request->all());

        return $this->successResponse($data);
    }

    public function update(Request $request, $exam)
    {
        // $rules = [
        //     'name' => 'max:255',
        //     'duration' => 'max:20',
        // ];

        // $this->validate($request, $rules);
        $exam = Exam::findOrFail($exam);
        $exam = $exam->fill($request->all());

        if ($exam->isClean()) {
            return $this->errorResponse(
                'at least one value must be change',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $exam->save();
        return $this->successResponse($exam);
    }


    public function destroy($exam)
    {

        $exam = Exam::findOrFail($exam);
        $exam->delete();
        return $this->successResponse($exam);
    }
}
