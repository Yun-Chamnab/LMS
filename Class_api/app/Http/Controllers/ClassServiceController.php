<?php

namespace App\Http\Controllers;

use App\Models\Classservice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassServiceController extends Controller
{

    public function index()
    {
        $class = Classservice::all();
        return $this->successResponse($class);
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

    public function show($class)
    {
        $class = Classservice::find($class);
        return $this->successResponse($class);
    }

    public function store(Request $request)
    {
        $rules = [
            'class_name' => 'required|max:255',
        ];

        $this->validate($request, $rules);
        $data = Classservice::create($request->all());

        return $this->successResponse($data);
    }

    public function update(Request $request, $class1)
    {
        // $rules = [
        //     'class_name' => 'max:255',
        // ];

        // $this->validate($request, $rules);
        $class1 = Classservice::findOrFail($class1);
        $class1 = $class1->fill($request->all());

        if ($class1->isClean()) {
            return $this->errorResponse(
                'at least one value must be change',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $class1->save();
        return $this->successResponse($class1);
    }


    public function destroy($class)
    {
        $class = Classservice::findOrFail($class);
        $class->delete();
        return $this->successResponse($class);
    }
}
