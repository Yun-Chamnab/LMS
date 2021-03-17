<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{

    public function index()
    {
        $question = Question::all();
        return $this->successResponse($question);
    }

    public function show($question)
    {
        $posts = Exam::with([
            'question.answer' => function ($query) {
                $query->get();
            },
        ])->where('id', $question)->get();

        return $this->successResponse($posts);
    }

    public function store(Request $request)
    {
        $question = Question::create([
            'question' => $request->question,
            'exam_id' => $request->exam_id,
            'score' => $request->score,
        ]);

        $arr_len = count($request->answer);
        for ($i = 0; $i < $arr_len; $i++) {

            $answer = $tss = new Answer;
            $tss->answer = $request->answer[$i];
            $tss->question_id = $question->id;
            $tss->exam_id = $request->exam_id;
            if ($request->status_correct == $tss->answer) {
                $tss->status_correct = 1;
            }

            // $tss->status_correct = $request->status_correct;
            $tss->save();
        }

        return $this->successResponse($answer);
    }

    public function update(Request $request, $question)
    {
        // $rules = [
        //     'name' => 'max:255',
        //     'duration' => 'max:20',
        //     'publish' => 'max:2',
        // ];

        // $this->validate($request, $rules);
        $question = Question::findOrFail($question);
        $question = $question->fill($request->all());

        if ($question->isClean()) {
            return $this->errorResponse(
                'at least one value must be change',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $question->save();
        return $this->successResponse($question);
    }


    public function destroy($question)
    {

        $question = Question::findOrFail($question);
        $question->delete();
        return $this->successResponse($question);
    }
}
