<?php

namespace App\Http\Controllers;

use App\Models\Filestore;
use App\Models\Lesson;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\UploadTrait;

class LessonController extends Controller
{
    use UploadTrait;

    public function index($lesson)
    {
        $lesson = Lesson::where('course_id', $lesson)->orderBy('created_at', 'desc')->get();
        return $this->successResponse($lesson);
    }


    public function show($lesson)
    {
        // $lesson = Lesson::find($lesson);
        // $uid = Lesson::uuid($lesson);
        $lesson = Lesson::with('filestore', 'videostore')->where('uuid', $lesson)->get();
        // $lesson = Filestore::with('lesson')->where('lesson_uuid', $lesson)->get();
        return $this->successResponse($lesson);
    }

    public function store(Request $request)
    {
        $rules = [
            'course_id' => 'required',
            'lesson' => 'required'
        ];

        $this->validate($request, $rules);

        $user = new Lesson;
        $user->course_id = $request->course_id;
        $user->lesson = $request->lesson;
        $user->description = $request->description;
        $user->save();
        if ($request->hasfile('file_path')) {

            foreach ($request->file('file_path') as $file) {

                $extension = $file->getClientOriginalName();
                $mhash = md5(time());
                $filename = ($mhash . '.' . $extension);
                $file->move('uploads/img/', $filename);

                $allfile = new Filestore;
                $allfile->lesson_uuid = $user->uuid;
                $allfile->file_path = $filename;

                $allfile->save();
            }
        }
        if ($request->video_link) {
            $allfile = new Video;
            $allfile->lesson_uuid = $user->uuid;
            $vl = $request->video_link;
            $v = count($vl);
            // foreach ($vl as $k) {
            for ($i = 0; $i < $v; $i++) {

                $allfile->video_link = $request->video_link[$i];
            }
            $allfile->save();
        }



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
