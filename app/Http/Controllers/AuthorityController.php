<?php
//权限管理控制台
namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class AuthorityController extends Controller
{
    //权限列表
    public function index(){
        $authoritys=Permission::orderBy('name')->paginate(7);
        return view('authority.index',compact('authoritys'));
    }

    //权限提交表单
    public function create(){
        return view('authority.create');
    }
    //权限添加验证
    public function store(Request $request){

        $this->validate($request,[
            'name'=>'required|',
            'name'=>'unique:test',
            'display_name'=>'required',
            'description'=>'required',

        ],[
            'name.required'=>'名字不能为空',
            'display_name.required'=>'显示名称不能为空',
            'description.required'=>'描述不能为空',
        ]);

        Permission::create([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'description'=>$request->description,
        ]);

        //回到首页
        return redirect()->route('authority.index');
    }

    //修改显示
    public function edit(Request $request,Permission $authority){

        return view('authority.edit',compact('authority'));

    }

    //修改保存
    public function update(Request $request,Permission $authority){

        $this->validate($request,[
            'name'=>'required',
            'display_name'=>'required',
            'description'=>'required',
        ],[
            'name.required'=>'名字不能为空',
            'display_name.required'=>'显示名称不能为空',
            'description.required'=>'描述不能为空',
        ]);

        $authority->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'description'=>$request->description,
        ]);

        //回到首页
        return redirect()->route('authority.index');

    }

    //权限ajax删除
    public function destroy (Permission $authority){
        $authority->delete();
        return redirect()->route('authority.index');
    }

}
