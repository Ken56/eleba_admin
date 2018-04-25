<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadeHandler;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //登录权限
    public function __construct(){
        //未登录的用户只能做什么
        $this->middleware('auth',['except'=>['']]);
        //让只能是未登录的用户访问的页面
//        $this->middleware('guest',['only' => ['create']]);
    }
    //商家分类管理
    public function index(Request $request){
        $fenye=$request->query();
        $keyword=$request->query();
        if($keyword){
            $categorys=Category::where('name','like',"%{$keyword}%")->paginate(4);
        }else{
            //查询数据
            $categorys=Category::paginate(4);
        }
        return view('business.index',compact('categorys','fenye'));
    }

    //添加商品分类-显示
    public function create(){
        return view('business.create');
    }
    public function store(Request $request){
        //验证信息啊
        $this->validate($request,[
            'name'=>'required',
        ],[
            'name.required'=>'商家名称不能为空',
        ]);

        //上传图片
        $uploder = new ImageUploadeHandler();
        $result  = $uploder->save($request->img,'category_img',0);
        if($result){
            $fileName = $result['path'];
        }else{
            $fileName = '';
        }

        //保存到数据库
        Category::create([
            'name'=>$request->name,
            'img'=>$fileName,
        ]);

        //返回数据
        session()->flash('success','添加成功');
        return redirect()->route('category.index');
    }

    //>>修改显示
    public function edit(Category $category){
        return view('business.edit',compact('category'));
    }

    //>>修改保存
    public function update(Request $request,Category $category){
        //验证信息啊
        $this->validate($request,[
            'name'=>'required',
        ],[
            'name.required'=>'商家名称不能为空',
        ]);

        //上传图片
        $uploder = new ImageUploadeHandler();
        $result  = $uploder->save($request->img,'category_img',0);
        if($result){
            $fileName = $result['path'];
        }else{
            $fileName = '';
        }

        //保存到数据库
        $category->update([
            'name'=>$request->name,
            'img'=>$fileName,
        ]);

        //返回数据
        session()->flash('success','修改成功');
        return redirect()->route('category.index');
    }

    //>>删除数据
    public function destroy (Category $category){
        $category->delete();
    }

}
