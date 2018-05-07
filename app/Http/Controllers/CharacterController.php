<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CharacterController extends Controller
{

    //权限列表
    public function index(){
        $characters=Role::all();
        return view('character.index',compact('characters'));
    }

    //权限提交表单
    public function create(){//->orderBy('name', 'desc')
        $permissions=Permission::all();
        return view('character.create',compact('permissions'));
    }
    //权限添加验证
    public function store(Request $request){

        $this->validate($request,[
            'name'=>'required|unique:roles',
            'display_name'=>'required',
            'description'=>'required',
        ],[
            'name.required'=>'名字不能为空',
            'name.unique'=>'名称已存在唯一',
            'display_name.required'=>'显示名称不能为空',
            'description.required'=>'描述不能为空',
        ]);


        $character = new Role();
        $character->name = $request->name;
        $character->display_name = $request->display_name;
        $character->description  = $request->description;
        $character->save();
        $character->attachPermissions($request->permission_id);

        //回到首页
        return redirect()->route('character.index');
    }

    //修改显示
    public function edit(Role $character){

        //查询出所有权限
        $permissions=Permission::all();

        //返回首页
        return view('character.edit',compact('character','permissions'));
    }

    //修改保存
    public function update(Request $request,Role $character){

        $this->validate($request,[
            'name'=>'required',
            'display_name'=>'required',
            'description'=>'required',
        ],[
            'name.required'=>'名字不能为空',
            'display_name.required'=>'显示名称不能为空',
            'description.required'=>'描述不能为空',
        ]);


        $character->name = $request->name;
        $character->display_name = $request->display_name;
        $character->description  = $request->description;
        $character->save();

        $character->syncPermissions($request->permission_id);

        //回到首页
        return redirect()->route('character.index');

    }

    //权限ajax删除
    public function destroy (Role $character){
        $character->delete();
        return redirect()->route('character.index');
    }

}
