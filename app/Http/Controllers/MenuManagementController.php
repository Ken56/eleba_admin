<?php
//菜单管理
namespace App\Http\Controllers;

use App\Models\MenuManagement;
use Illuminate\Http\Request;

class MenuManagementController extends Controller
{
    //>>菜单首页
    public function index(){

        $menuManagements=MenuManagement::all();
        foreach ($menuManagements as $menuManagement){
            if($menuManagement->parent_id==0){
                $menuManagement->pid_name='顶级菜单';
            }else{
                $menuManagement->pid_name=MenuManagement::where('id',$menuManagement->parent_id)->first()->name;//pid是父名称
            }

        }

        return view('menu.index',compact('menuManagements'));
    }
    public function create(){

        $menumanagements=MenuManagement::all();
        return view('menu.create',compact('menumanagements'));

    }

    public function store(Request $request){

        //无限极分类逻辑
        $this->validate($request,[
            'name'=>'required',
            'menu_route'=>'required',
            'sorting'=>'required',
        ],[
            'name.required'=>'名字不能为空',
            'menu_route.required'=>'路由不能为空',
            'sorting.required'=>'排序不能为空',
        ]);

        MenuManagement::create([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'menu_route'=>$request->menu_route,
            'sorting'=>$request->sorting,
        ]);

        session()->flash('success', '添加成功');
        return redirect()->route('menu.index');
    }

    //修改回显
    public function edit(MenuManagement $menu){
        $menus = MenuManagement::all();
        return view('menu.edit',compact('menus','menu'));

    }

    //修改保存
    public function update(Request $request,MenuManagement $menu){
        //无限极分类逻辑
        $this->validate($request,[
            'name'=>'required',
            'menu_route'=>'required',
            'sorting'=>'required',
        ],[
            'name.required'=>'名字不能为空',
            'menu_route.required'=>'路由不能为空',
            'sorting.required'=>'排序不能为空',
        ]);
        $menu->update([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'menu_route'=>$request->menu_route,
            'sorting'=>$request->sorting,
        ]);

        session()->flash('success', '修改成功');
        return redirect()->route('menu.index');

    }


    //权限ajax删除
    public function destroy (MenuManagement $menu){
        $menu->delete();
// ajax       return redirect()->route('menu.index');
    }
}
