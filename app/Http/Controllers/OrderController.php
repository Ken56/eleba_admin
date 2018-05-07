<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Goods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //商家管理订单
    public function index(Request $request){
        $fenye=$request->query();
        $keyword=$request->query();
        if($keyword){
            $wheres[]=['name','like',"%{$keyword}%"];
        }
        $orders=Order::paginate(4);
        foreach ($orders as $order){
            $order_goods=Order_Goods::where('order_id',$order->id)->get();
            $order->food=$order_goods;
            foreach ($order_goods as $goods_price){
                $order->price+=$goods_price['goods_price']*$goods_price['amount'];
            }
        }
        return view('order.index',compact('orders','fenye'));
    }

    //查看订单
    public function show(Request $request,Order $order){

        $order=Order::where('id',$order->id)->first();

        //加载页面
        return view('order.show',compact('order'));
    }

    //修改订单状态
    public function edit(Order $order){
//        var_dump($order);die;
        if($order->order_status==0){
            $res=$order->order_status=1;
        }elseif ($order->order_status==1){
            $res=$order->order_status=-1;
        } elseif ($order->order_status==-1){
            $res=$order->order_status=1;
        } elseif ($order->order_status==3){
            $res=$order->order_status=-1;
        } elseif ($order->order_status==2){
            $res=$order->order_status=-1;
        }
        $order->where('id',$order->id)->update([
            'order_status'=>$res
        ]);
        return redirect()->route('order.index');

    }

    //发货修改
    public function fahuo(Order $order){
        if($order->order_status==1){
            $res=$order->order_status=2;
        }
        $order->where('id',$order->id)->update([
            'order_status'=>$res
        ]);
        return redirect()->route('order.index');
    }

    //订单统计显示
    public function dingdan(Request $request){
        $fenye=$request->query();
        $keyword=$request->query();

        //区间查询相关代码

//        var_dump($start_time);die;
        if($request->start_time && $request->start_time){//查不到旧设置一个0
            $start_time=$request->start_time;
            $end_time=$request->end_time;
            $wheres=[
                ['created_at','>',date('Y-m-d',strtotime($start_time)),],
                ['created_at','<',date('Y-m-d',strtotime($end_time)),],
            ];
            $search=DB::table('order_list')->where($wheres)->get();
        }else{
            $search=[];
        }
//        $search_count=DB::table('order_list')->where($wheres)->count();


//        if($keyword){
//            $wheres[]=['name','like',"%{$keyword}%"];
//        }

        //当天 当月 总计 的查询条件
        $dayx=[
            ['created_at','>',date('Y-m-d',time()),],
            ['created_at','<',date('Y-m-d',strtotime('+1 day'))],
        ];
        $monthx=[
            ['created_at','>',date('Y-m-01',strtotime(date('Y-m-d')))],
            ['created_at','<',date('Y-m-d',strtotime('+1 month'))],
        ];

        //当天 当月 总计 数量显示
        $day=DB::table('order_list')->where($dayx)->count();
        $month=DB::table('order_list')->where($monthx)->count();
        $count=DB::table('order_list')->count();
        return view('order.order_statistics',compact('count','day','month','search'));

    }

    //菜品统计管理
    public function caipin(Request $request){
        $fenye=$request->query();
        $keyword=$request->query();

        //区间查询相关代码
        if($request->start_time && $request->start_time){//查不到旧设置一个0
            $start_time=$request->start_time;
            $end_time=$request->end_time;
            $wheres=[
                ['order_goods.created_at','>',date('Y-m-d',strtotime($start_time)),],
                ['order_goods.created_at','<',date('Y-m-d',strtotime($end_time)),],
            ];

            //使用高级查询
            $foods=DB::table('order_goods')
                ->join('order_list','order_goods.order_id','=','order_list.id')
                ->join('shops','order_list.shop_id','=','shops.id')
                ->select('shops.shop_name','order_goods.goods_name',DB::raw('sum(order_goods.amount) as amount'))
                ->where($wheres)
                ->groupBy('order_goods.goods_name','shops.shop_name')
                ->orderBy('amount','desc')
                ->get();
            ;

        }else{
            $foods=[];
        }


//        if($keyword){
//            $wheres[]=['name','like',"%{$keyword}%"];
//        }


        //当天 当月 总计 数量显示
        $dd=DB::table('order_list')->get();
        $day=0;
        foreach ($dd as $d){
            $day=DB::table('order_goods')->where([
                ['created_at','>',date('Y-m-d',time()),],
                ['created_at','<',date('Y-m-d',strtotime('+1 day'))],
            ])->sum('amount');
        }

        $mm=DB::table('order_list')->get();
        $month=0;
        foreach ($mm as $m){
            $month+=DB::table('order_goods')->where([
                ['created_at','>',date('Y-m-01',strtotime(date('Y-m-d')))],
                ['created_at','<',date('Y-m-d',strtotime('+1 month'))],
            ])->sum('amount');
        }

        $cc=DB::table('order_list')->get();
        $count=0;
        foreach ($cc as $c){
            $count+=DB::table('order_goods')->where('order_id',$c->id)->sum('amount');
        }

        return view('order.goods_statistics',compact('count','day','month','foods'));
    }
}
