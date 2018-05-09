<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
            //查询数据
            $shops=User::paginate(4);
        return view('shop.index',compact('shops'));
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

    //管理员 添加 商家
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
                'shop_img'=>$request->shop_img,
                'notice'=>$request->notice,
                'discount'=>$request->discount,
            ]);

            //添加数据商家账户表
            User::create([
                'name'=>$request->name,
                'tel'=>$request->tel,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'status'=>1,
                'shop_id'=>$keyx->id,
            ]);


        });
        session()->flash('success','添加成功');
        return redirect()->route('shop.index');
    }


    //商家审核发邮箱
    public function status(User $shop){
        $res=$shop->status==1?0:1;
        if ($shop->status==0){//发送过来是0发送邮箱1099321358@qq.com祝海洋 商家审核通过 $shop->name 你的账号已经审核通过 欢迎入住我们的平台 欢迎入驻皇家赌场俱乐部
            Mail::send(
                'mail',//需要一个邮箱模板地址
                ['name'=>$shop->name],//名字
                function ($message) use ($shop){//subject是邮箱标题
                    $message->to($shop->email)->subject('饿了吧账号审核通过');
                }
            );
        }

        $shop->where('id',$shop->id)->update([
            'status'=>$res
        ]);

        return redirect()->route('shop.index');
    }
    //修改店铺信息
    public function edit(Shop $shop){
        $categorys=DB::table('categories')->get();
        return view('shop.edit',compact('shop','categorys'));
    }
//修改店铺信息
    public function update(Request$request,Shop $shop){
//        var_dump($shop);die;
        //验证
        $this->validate($request,[
            'shop_name'=>'required',
        ],[
            'shop_name.required'=>'店铺名称不能为空',
        ]);

        //保存到两个数据库

            //添加到详细表
            $shop->update([
                'shop_name'=>$request->shop_name,
                'shop_rating'=>$request->shop_rating,
                'brand'=>$request->brand,
                'on_time'=>$request->on_time,
                'fengniao'=>$request->fengniao,
                'bao'=>$request->bao,
                'piao'=>$request->piao,
                'zhun'=>$request->zhun,
                'start_send'=>$request->start_send,
                'send_cost'=>$request->send_cost,
                'estimate_time'=>$request->estimate_time,
                'notice'=>$request->notice,
                'discount'=>$request->discount,
                'category_id'=>$request->category_id,
            ]);

        session()->flash('success','修改成功');
        return redirect()->route('shop.index');
    }

}
