<?php
//抽奖活动管理
namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    //>>活动列表主页
    public function index(){

            $events=Events::paginate(4);

        return view('events.index',compact('events'));
    }

    //查看抽奖详情
    public function show(Events $event){
        //找到所有报名人数---判断限制人数
        $man_count=DB::table('event_members')->where(['events_id'=>$event->id])->count();
        return view('events.show',compact('event','man_count'));
    }

    //添加商品分类-显示
    public function create(){
        return view('events.create');
    }

    public function store(Request $request){
        //验证信息啊
        $this->validate($request,[
            'title'=>'required',
            'signup_start'=>'required|after:yesterday',
            'signup_end'=>'required|after:start',
            'contentx'=>'required',
            'signup_num'=>'required',
            'prize_date'=>'required|after:yesterday',
        ],[
            'title.required'=>'标题不能为空',
            'signup_start.required'=>'开始时间不能为空',
            'signup_start.after'=>'开始时间错误',
            'signup_end.required'=>'结束时间不能为空',
            'signup_end.after'=>'结束时间错误',
            'signup_num.required'=>'人数限制不能为空',
            'prize_date.required'=>'开奖时间不能为空',
            'prize_date.after'=>'开奖时间不正确',
        ]);
        //保存到数据库
        Events::create([
            'title'=>$request->title,
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'contentx'=>$request->contentx,
            'prize_date'=>$request->prize_date,//开奖时间
            'signup_num'=>$request->signup_num,//人数限制
        ]);

        //返回数据
        session()->flash('success','活动添加成功');
        return redirect()->route('events.index');
    }

    //>>修改显示
    public function edit(Events $event){
        return view('events.edit',compact('event'));
    }

    //>>抽奖开奖
    public function kaijiang(Events $event){
        $is_prize=$event->is_prize==0?1:0;
        $event->update([
           'is_prize'=>$is_prize
        ]);

        //返回数据
        return redirect()->route('events.index');
    }

    //>>修改保存
    public function update(Request $request,Events $event){
        //验证信息啊
        $this->validate($request,[
            'title'=>'required',
            'signup_start'=>'required|after:yesterday',
            'signup_end'=>'required|after:start',
            'contentx'=>'required',
            'signup_num'=>'required',
            'prize_date'=>'required|after:yesterday',
        ],[
            'title.required'=>'标题不能为空',
            'signup_start.required'=>'开始时间不能为空',
            'signup_start.after'=>'开始时间错误',
            'signup_end.required'=>'结束时间不能为空',
            'signup_end.after'=>'结束时间错误',
            'signup_num.required'=>'人数限制不能为空',
            'prize_date.required'=>'开奖时间不能为空',
            'prize_date.after'=>'开奖时间不正确',
        ]);
        //保存到数据库
        $event->update([
            'title'=>$request->title,
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'contentx'=>$request->contentx,
            'prize_date'=>$request->prize_date,//开奖时间
            'signup_num'=>$request->signup_num,//人数限制
        ]);

        //返回数据
        session()->flash('success','抽奖修改成功');
        return redirect()->route('events.index');
    }

    //>>删除数据
    public function destroy (Events $event){
        session()->flash('success','删除成功');
        $event->delete();
    }

    //查看报名商家账号
    public function eventsUser(Events $event){
        $events=DB::table('event_members')->where('events_id',$event->id)->get();
        var_dump($events);die;
        foreach ($events as $val){
            $eventsUser=DB::table('user')->where('id',$val->member_id)->get();
        }

        return view('events.events_user',compact('eventsUser'));
    }

}
