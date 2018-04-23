<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadeHandler;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    //登录权限
    public function __construct(){
        //游客权限--黑名单
        $this->middleware('auth',['except'=>['create','store']]);
        //用户权限-白名单
        $this->middleware('guest',['only'=>'create']);
    }

    //管理员个人中心
    public function index(){
        //这里判断审核状态 session()的状态值
        return view('admin.index');
    }

    //添加商品分类-显示
    public function create(){
        return view('admin.create');
    }
    public function store(Request $request){
        //验证信息啊
        $this->validate($request,[
            'name'=>'required',
        ],[
            'name.required'=>'名字',
        ]);
        Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);

        //返回数据
        session()->flash('success','添加成功');
        return redirect()->route('admin.index');
    }

    //修改密码表单
    public function updatepwd(){
        return view('sessions.edit');
    }

    //>>修改密码
    public function update_pwd(Request $request)
    {
//        var_dump($request->password);die;
//        var_dump($request->input('password'));die;
//        $user_id=Auth::user()->id;//保存用户密码
        //验证新旧密码

        //基础验证
        $this->validate($request,[
            'old_pwd'=>'required',
            'password'=>'required',
        ],[
            'old_pwd.required'=>'旧密码不能为空',
            'password.required'=>'密码不能为空',
        ]);

        $id = Auth::user()->id;
        $oldpassword = $request->input('old_pwd');
        $newpassword = $request->input('password');
        $res = DB::table('admins')->where('id', $id)->select('password')->first();
        if (!Hash::check($oldpassword, $res->password)) {
            session()->flash('success', '旧密码不正确');
            return redirect()->route('updatepwd');
        }
        $update = array(
            'password' => bcrypt($newpassword),
        );
        $result = DB::table('admins')->where('id', $id)->update($update);
        if ($result) {
            session()->flash('success', '密码修改成功');
            return redirect()->route('shop.index');
        } else {
            session()->flash('success', '密码修改失败');
            return redirect()->route('updatepwd');
        }
    }

}
