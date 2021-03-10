<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $question = Exam::with('question')->get();
        $response = Question::with('exam')->get();
        return $this->successResponse($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $question = Question::create(['question' => $request->question, 'exam_id' => $request->exam_id]);

        $arr_len = count($request->answer);
        for ($i = 0; $i < $arr_len; $i++) {

            $answer = $tss = new Answer;
            $tss->answer = $request->answer[$i];
            $tss->question_id = $question->id;
            $tss->status_correct = $request->status_correct;
            $tss->save();
        }

        return $this->successResponse($answer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($exam)
    {
        $ex = Exam::find($exam);
        $question = Question::with('exam')->where('exam_id', $ex)->get();
        // dd($question);
        return $this->successResponse($ex);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $id)
    {
        return Question::destroy($id);
    }
}
