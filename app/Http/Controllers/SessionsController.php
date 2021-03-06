<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    //登录表单
    public function create(){
        return view('sessions.create');
    }

    //登录验证
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha',
        ],[
            'name.required'=>'名称不能为空',
            'password.required'=>'密码不能为空',
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码必须正确',
        ]);
        if(Auth::attempt(['name'=>$request->name,'password'=>$request->password],$request->has('remember'))){
            session()->flash('success','登录成功,欢迎回来');
            return redirect()->route('admin.index');
        }else{
            session()->flash('success','登录失败,请重新登录');
            return redirect()->route('login');
        }
    }

    //>>注销功能
    public function destroy(){
        Auth::logout();
        session()->flash('success','注销成功');
        return redirect()->route('login');
    }
}
