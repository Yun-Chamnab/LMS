<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Exam;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResultController extends Controller
{

    public function index()
    {
        $result = Result::all();
        return $this->successResponse($result);
    }

    public function indexStudent()
    {
        $result = Result::where('publish', '1')->get();
        return $this->successResponse($result);
    }

    public function show($result)
    {
        $result = Result::find($result);
        return $this->successResponse($result);
    }

    public function store(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'quiz_id' => 'required',
            'score' => 'required',
        ];

        $this->validate($request, $rules);
        $data = Result::create($request->all());

        return $this->successResponse($data);
    }

    public function update(Request $request, $result)
    {
        // $rules = [
        //     'name' => 'max:255',
        //     'duration' => 'max:20',
        // ];

        // $this->validate($request, $rules);
        $result = Result::findOrFail($result);
        $result = $result->fill($request->all());

        if ($result->isClean()) {
            return $this->errorResponse(
                'at least one value must be change',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $result->save();
        return $this->successResponse($result);
    }


    public function destroy($result)
    {

        $result = Result::findOrFail($result);
        $result->delete();
        return $this->successResponse($result);
    }
}
