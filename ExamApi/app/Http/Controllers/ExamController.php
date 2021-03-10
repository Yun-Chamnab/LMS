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

    public function show($exam)
    {
        $exam = Exam::find($exam);
        return $this->successResponse($exam);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'duration' => 'required|max:20',
            'publish' => 'required|max:2',
        ];

        $this->validate($request, $rules);
        $data = Exam::create($request->all());
      
        return $this->successResponse($data);
    }

    public function update(Request $request, $exam)
    {
        $rules = [
            'name' => 'max:255',
            'duration' => 'max:20',
            'publish' => 'max:2',
        ];

        $this->validate($request, $rules);
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
