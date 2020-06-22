<?php

namespace App\Http\Controllers\User\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Tag;
use App\Question;
use App\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_post_question()
    {
        $categories = Category::get();
        $tags = Tag::get();
        return view('user.home.question_post',compact('categories','tags'));
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
    public function user_submit_question(Request $request)
    {
        $this->validate($request,[
            'category'=>'required|array',
            'tag'=>'required|array',
            'question'=>'required|min:10|max:191',
            'status'=>'required'
        ]);
        $user_id = Auth::user()->id;   
        $question_ins = new Question;
        $question_ins->user_id = $user_id;
        $question_ins->question = $request->question;
        $question_ins->slug = str_slug($request->question);
        $question_ins->description = $request->description;
        $question_ins->status = $request->status;
        $question_ins->save();

        $category_ins = Question::find($question_ins->id)->categories()->attach($request->category);
        $tag_ins = Question::find($question_ins->id)->tags()->attach($request->tag);
        if(@$question_ins && @$category_ins && @$tag_ins)
        {
            Session::flash('success','Question submited.');
        }else{
            Session::flash('error','Question not submited.');
        }
        
        return redirect()->route('user_post_question');
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function user_answer_submit(Request $request)
    {
        $this->validate($request,[
            'answer'=>'required|max:191|unique:answers',
            'description'=>'required',
            'status'=>'required',
            'question_id'=>'required'
        ]);
        $user_id = Auth::user()->id;   
        $answer_ins = new Answer;
        $answer_ins->user_id = $user_id;
        $answer_ins->question_id = $request->question_id;
        $answer_ins->answer = $request->answer;
        $answer_ins->slug = str_slug($request->answer);
        $answer_ins->description = $request->description;
        $answer_ins->status = $request->status;
        $answer_ins->save();

        if(@$answer_ins)
        {
            Session::flash('success','Answer Submited.');
        }else{
            Session::flash('error','Answer not Submited.');
        }
        
        return redirect()->back();
    }
         /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function user_answer_edit_submit(Request $request, $slug)
    {
        $this->validate($request,[
            'answer'=>'required|max:191|unique:answers,slug,'.$slug,
            'description'=>'required',
            'status'=>'required',
            'question_id'=>'required'
        ]);
        $user_id = Auth::user()->id;   
        $answer_up = Answer::where('slug',$slug)->first();
        $answer_up->user_id = $user_id;
        $answer_up->question_id = $request->question_id;
        $answer_up->answer = $request->answer;
        $answer_up->slug = str_slug($request->answer);
        $answer_up->description = $request->description;
        $answer_up->status = $request->status;
        $answer_up->save();

        if(@$answer_up)
        {
            Session::flash('success','Answer Updated.');
        }else{
            Session::flash('error','Answer not Updated.');
        }
        $qu_slug = $answer_up->question->slug;
        return redirect()->route('user_question',['slug'=>$qu_slug]);
    }   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_question_edit($slug)
    {
        $question_edit = Question::where('slug',$slug)->first();
        $categories = Category::get();
        $tags = Tag::get();
        return view('user.home.question_post',compact('categories','tags','question_edit'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_ans_edit($slug)
    {
        $answer_edit = Answer::where('slug',$slug)->first();
        $qu_slug = $answer_edit->question->slug;
        $question = Question::where('slug',$qu_slug)->first();
        $categories = Category::get();
        $tags = Tag::get();
        return view('user.home.question_details',compact('categories','tags','question','answer_edit'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_edit_question(Request $request, $slug)
    {
        $this->validate($request,[
            'category'=>'required|array',
            'tag'=>'required|array',
            'question'=>'required|min:10|max:191',
            'status'=>'required'
        ]);
        $user_id = Auth::user()->id;   
        $question_up = Question::where('slug',$slug)->first();
        $question_up->user_id = $user_id;
        $question_up->question = $request->question;
        $question_up->slug = str_slug($request->question);
        $question_up->description = $request->description;
        $question_up->status = $request->status;
        $question_up->save();

        $category_detach = Question::find($question_up->id)->categories()->detach();
        $tag_detach = Question::find($question_up->id)->tags()->detach();
        $category_up = Question::find($question_up->id)->categories()->attach($request->category);
        $tag_up = Question::find($question_up->id)->tags()->attach($request->tag);
        if(@$question_up && @$category_up && @$tag_up)
        {
            Session::flash('success','Question Updated.');
        }else{
            Session::flash('error','Question not Updated.');
        }
        
        return redirect()->route('user_questions');
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
