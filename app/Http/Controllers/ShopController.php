<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{

    //登录权限
    public function __construct(){
        //未登录的用户只能做什么
        $this->middleware('auth',['except'=>['']]);
        //让只能是未登录的用户访问的页面
//        $this->middleware('guest',['only' => ['create']]);
    }

    //商家账号管理
    public function index(Request $request){
        $fenye=$request->query();
        $keyword=$request->query();
        if($keyword){
            $shops=User::where('name','like',"%{$keyword}%")->paginate(4);
        }else{
            //查询数据
            $shops=User::paginate(4);
        }
        return view('shop.index',compact('shops','fenye'));
    }

    //店铺详情页
    public function show(User $shop){
        $id=$shop->shop_id;
        $shop=Shop::find($id);
        return view('shop.show',compact('shop'));
    }

    //后台添加
    public function create(){
        $categorys=DB::table('categories')->get();
        return view('shop.create',compact('categorys'));
    }

    //商家注册首页
    public function store(Request $request){
        //验证
        $this->validate($request,[
            'name'=>'required',
        ]);

        //保存到两个数据库
        DB::transaction(function ()use ($request) {

            //添加到详细表
            $keyx=Shop::create([
                'shop_name'=>$request->shop_name,
                'category_id'=>$request->category_id,
                'start_send'=>$request->start_send,
                'send_cost'=>$request->send_cost,
                'on_time'=>$request->on_time,
                'fengniao'=>$request->fengniao,
                'shop_img'=>$request->img,
                'notice'=>$request->notice,
                'discount'=>$request->discount,
            ]);

            //添加数据商家账户表
            User::create([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'password'=>bcrypt($request->password),
                'status'=>1,
                'shop_id'=>$keyx->id,
            ]);


        });
        session()->flash('success','添加成功');
        return redirect()->route('shop.index');
    }


    //审核
    public function status(User $shop){
        $res=$shop->status==1?0:1;
//        var_dump($res);die;
        $shop->where('id',$shop->id)->update([
            'status'=>$res
        ]);
        return redirect()->route('shop.index');
    }
}
