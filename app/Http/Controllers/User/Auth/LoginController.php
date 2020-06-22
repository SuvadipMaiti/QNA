<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('user.auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('user.auth.register');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = Auth::user();
        return view('user.auth.profile',compact('user'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profile_update(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|max:255'
        ]);
        $user = Auth::user();
        $user_up = User::find($user->id);
        $user_up->name = $request->username;
        $user_up->email = $request->email;
        $user_up->save(); 

        $profile = $user_up->profile ?: new Profile;
        if($request->hasFile('avatar'))
        {
            $img_file = $request->avatar;
            $img_new_name = time().$img_file->getClientOriginalName();
            $img_file->move('uploads/images',$img_new_name);
            $profile->avatar = $img_new_name;
        }

        $profile->mobile = $request->mobile;
        $profile->city = $request->city;
        $profile->country = $request->country;
        $profile->pin = $request->pin;
        $profile->address = $request->address;
        $profile->about = $request->about;
        $profile->facebook = $request->facebook;
        $profile->youtube = $request->youtube;
        $profile->twitter = $request->twitter;
        $profile->linkdin = $request->linkdin;
        $profile->google = $request->google;
        $profile->instagram = $request->instagram;        
        $user_up->profile()->save($profile);
        
        if(@$user_up){
            Session::flash('success','Profile Updated.');
            return redirect()->route('user_profile');
        }else{
            Session::flash('error','Profile Not Updated.');
            return redirect()->back();
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->route('user_register')->withErrors($validator)->withInput();
        }
    
        $user_reg = new User;
        $user_reg->name = $request->username;
        $user_reg->email = $request->email;
        $user_reg->type = "user";
        $user_reg->password = Hash::make($request->password);
        $user_reg->save();    
        if(@$user_reg){
            Session::flash('success','Registration Sucessfull.');
            return redirect()->route('user_login');
        }else{
            Session::flash('error','Registration Failed.');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login_submit(Request $request)
    {
        
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'type' => 'user'])) {
            Session::flash('success','Login Sucessfull.');
            return redirect()->route('user_profile');
        }else{
            Session::flash('error','Login Failed.');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        Auth::logout();
        Session::flash('success','Logout Sucessfull.');
        return redirect()->route('user_login');

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
