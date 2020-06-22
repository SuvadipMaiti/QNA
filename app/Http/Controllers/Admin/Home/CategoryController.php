<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('admin.home.category_list',compact('categories'));
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
            'category'=>'required|max:255|unique:categories',
            'description'=>'required'
        ]);
        $category_ins = new Category;
        $category_ins->category = $request->category;
        $category_ins->slug = str_slug($request->category);
        $category_ins->description = $request->description;
        $category_ins->status = 1;
        $category_ins->save();
        if(@$category_ins)
        {
            Session::flash('success','category created.');
            return redirect()->route('category_list');
        }else{
            Session::flash('error','category not created.');
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
        $categories = Category::get();
        $category_edit = Category::where('slug',$slug)->first();
        return view('admin.home.category_list',compact('categories','category_edit'));
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
        $category_up = Category::where('slug',$slug)->first();
        if(!empty($category_up)){
            $category_up->category = $request->category;
            $category_up->slug = str_slug($request->category);
            $category_up->description = $request->description;
            $category_up->save();
            Session::flash('success','category Updated.');
            return redirect()->route('category_list');
        }else{
            Session::flash('error','category not Updated');
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
        $category_del = Category::where('slug',$slug)->first();
        if(!empty($category_del)){
            $category_del->delete();
            Session::flash('success','Category Deleted');
            return redirect()->route('category_list');
        }else{
            Session::flash('error','Category not Deleted');
            return redirect()->back();
        }
        
    }
}
