<?php

namespace App\Http\Controllers;

use App\Models\Lesson;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\UploadTrait;

class LessonController extends Controller
{
    use UploadTrait;

    public function index()
    {
        $lesson = Lesson::all();
        return $this->successResponse($lesson);
    }


    public function show($lesson)
    {
        $lesson = Lesson::find($lesson);
        return $this->successResponse($lesson);
    }

    public function store(Request $request)
    {
        // $rules = [
        //     'user_id' => 'required|max:255',
        // ];

        // $this->validate($request, $rules);

        $user = new Lesson;
        $user->lesson = $request->lesson;

        if ($request->hasfile('file_path')) {
            $file = $request->file('file_path');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/img/', $filename);
            $user->file_path = $filename;
        }
        $user->save();
       

        return $this->successResponse($user);
    }

    public function update(Request $request, $lesson)
    {
        // $rules = [
        //     'class_name' => 'max:255',
        // ];

        // $this->validate($request, $rules);
        $lesson = Lesson::findOrFail($lesson);
        $lesson = $lesson->fill($request->all());

        if ($lesson->isClean()) {
            return $this->errorResponse(
                'at least one value must be change',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $lesson->save();
        return $this->successResponse($lesson);
    }


    public function destroy($lesson)
    {

        $lesson = Lesson::findOrFail($lesson);
        $lesson->delete();
        return $this->successResponse($lesson);
    }
}
