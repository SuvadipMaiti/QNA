<?php

namespace App\Http\Controllers\User\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;
use App\Category;
use App\Question;
use App\Check;
use App\Answer;
use App\Visitor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::where('status',1)->orderBy('created_at','DESC')->paginate(10);
        $categories = Category::get();
        $tags = Tag::get();
        return view('user.home.home',compact('questions','categories','tags'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_questions()
    {
        $ip_address = request()->ip();
        $user_id = Auth::user()->id;
        $questions = Question::where('user_id',$user_id)->orderBy('created_at','DESC')->paginate(10);
        $categories = Category::get();
        $tags = Tag::get();
        return view('user.home.questions_user',compact('questions','categories','tags','ip_address'));
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
            return view('user.home.question_details',compact('categories','tags','question'));
        }
        else
        {
            Session::flash('error','Question not found.');
            return redirect()->back();
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
        $clientIP = request()->ip();
        $check = Check::where('ip_address',$clientIP)->where('answer_id',$answer->id)->first();
        if(!@$check)
        {
            $check_ins = new Check;
            $check_ins->ip_address = $clientIP;
            $check_ins->answer_id = $answer->id;
            $check_ins->slug = $slug;
            $check_ins->save();
            Session::flash('success','Checked.');
        }else{
            $check->delete();
            Session::flash('error','Not Checked.');
        }
        $qu_slug = $answer->question->slug;
        return redirect()->route('user_question',['slug'=>$qu_slug]);
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
