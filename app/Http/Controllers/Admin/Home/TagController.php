<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;
use Session;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::get();
        return view('admin.home.tag_list',compact('tags'));
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
        $this->validate($request,[
            'tag'=>'required|max:255|unique:tags',
            'description'=>'required'
        ]);
        $tag_ins = new Tag;
        $tag_ins->tag = $request->tag;
        $tag_ins->slug = str_slug($request->tag);
        $tag_ins->description = $request->description;
        $tag_ins->status = 1;
        $tag_ins->save();
        if(@$tag_ins)
        {
            Session::flash('success','Tag created.');
            return redirect()->route('tag_list');
        }else{
            Session::flash('error','Tag not created.');
            return redirect()->back();
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $tags = Tag::get();
        $tag_edit = Tag::where('slug',$slug)->first();
        return view('admin.home.tag_list',compact('tags','tag_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $tag_up = Tag::where('slug',$slug)->first();
        if(!empty($tag_up)){
            $tag_up->tag = $request->tag;
            $tag_up->slug = str_slug($request->tag);
            $tag_up->description = $request->description;
            $tag_up->save();
            Session::flash('success','Tag Updated.');
            return redirect()->route('tag_list');
        }else{
            Session::flash('error','Tag not Updated');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $tag_del = Tag::where('slug',$slug)->first();
        if(!empty($tag_del)){
            $tag_del->delete();
            Session::flash('success','Tag Deleted');
            return redirect()->route('tag_list');
        }else{
            Session::flash('error','Tag not Deleted');
            return redirect()->back();
        }
        
    }
}
