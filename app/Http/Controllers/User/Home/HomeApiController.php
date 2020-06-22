<?php

namespace App\Http\Controllers\User\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Question;
use App\Tag;
use App\Category;
use App\Visitor;
use App\Answer;
use App\Check;

class HomeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::where('status',1)->paginate(10);
        $categories = Category::get();
        $tags = Tag::get();

        return response()->json([
                    'questions' => $questions,
                    'categories' => $categories,
                    'tags' => $tags,
                    'status' => 1
                ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function question($slug)
    {
        $question = Question::where('slug',$slug)->first();
        if(@$question){
            $clientIP = request()->ip();
            $visitor = Visitor::where('ip_address',$clientIP)->where('question_id',$question->id)->first();
            if(!@$visitor)
            {
                $visitor_ins = new Visitor;
                $visitor_ins->ip_address = $clientIP;
                $visitor_ins->question_id = $question->id;
                $visitor_ins->slug = $slug;
                $visitor_ins->save();
            }
            $categories = Category::get();
            $tags = Tag::get();

            return response()->json([
                'question' => $question,
                'categories' => $categories,
                'tags' => $tags,
                'status' => 1
            ],200);
        }
        else
        {
            return response()->json([
                'status' => 0
            ],400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function correct_ans_check($slug)
    {
        $answer = Answer::where('slug',$slug)->first();
        if(@$answer){
            $clientIP = request()->ip();
            $check = Check::where('ip_address',$clientIP)->where('answer_id',$answer->id)->first();
            if(!@$check)
            {
                $check_ins = new Check;
                $check_ins->ip_address = $clientIP;
                $check_ins->answer_id = $answer->id;
                $check_ins->slug = $slug;
                $check_ins->save();

                return response()->json([
                    'check' =>$check_ins,
                    'status' => 1
                ],201);

            }else{
                $check->delete();
                return response()->json([
                    'status' => 1
                ],204);
            }
        }
        else
        {
            return response()->json([
                'status' => 0
            ],400);
        }
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
    public function destroy($id)
    {
        //
    }
}
