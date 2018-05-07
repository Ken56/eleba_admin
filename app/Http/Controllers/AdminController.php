<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadeHandler;
use App\Models\Admin;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //登录权限
    public function __construct(){
        //未登录的用户只能做什么
        $this->middleware('auth',['except'=>['']]);
        //让只能是未登录的用户访问的页面
//        $this->middleware('guest',['only' => ['create']]);
    }

    //管理员个人中心
    public function index(){
        $admins=Admin::all();
        return view('admin.index',compact('admins'));
    }

    //管理员注册
    public function create(){
        $roles=Role::all();
        return view('admin.create',compact('roles'));
    }
    public function store(Request $request){
        //验证信息啊
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ],[
            'name.required'=>'名称不能为空',
            'email.required'=>'邮箱不能为空',
            'password.required'=>'密码不能为空',
        ]);
//        $admin=Admin::create([
//            'name'=>$request->name,
//            'email'=>$request->email,
//            'password'=>bcrypt($request->password),
//        ]);

        $admin=new Admin();
        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->password=bcrypt($request->password);
        $admin->save();
        //为用户分配角色
        $admin->attachRoles($request->role_id);

        //返回数据
        session()->flash('success','添加成功');
        return redirect()->route('admin.index');
    }

    //修改密码表单
    public function updatePwd(Request $request,Admin $admin){

        //查询出所有权限
        $roles=Role::all();
        return view('sessions.edit',compact('admin','roles'));
    }

    //>>修改密码
    public function update(Request $request,Admin $admin)
    {
        //验证新旧密码

        //基础验证
        $this->validate($request,[
            'old_pwd'=>'required',
            'password'=>'required',
            'role_id'=>'required',
        ],[
            'old_pwd.required'=>'旧密码不能为空',
            'password.required'=>'密码不能为空',
            'role_id.required'=>'角色不能为空',
        ]);

        $id = Auth::user()->id;
        $oldpassword = $request->input('old_pwd');
        $newpassword = $request->input('password');
        $res = DB::table('admins')->where('id', $id)->select('password')->first();
        //哈希验证密码
        if (!Hash::check($oldpassword, $res->password)) {
            session()->flash('success', '旧密码不正确');
            return redirect()->route('updatepwd');
        }

        $result = DB::table('admins')->where('id', $id)->update([
            'password' => bcrypt($newpassword),
        ]);

        $admin->syncRoles($request->role_id);

        if ($result) {
            session()->flash('success', '密码修改成功');
            return redirect()->route('admin.index');
        } else {
            session()->flash('success', '密码修改失败');
            return redirect()->route('updatepwd');
        }
    }

}
