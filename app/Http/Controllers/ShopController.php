<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{

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
