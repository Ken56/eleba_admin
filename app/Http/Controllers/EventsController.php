<?php
//抽奖活动管理
namespace App\Http\Controllers;

use App\Models\Event_Members;
use App\Models\Events;
use App\Models\Prize;
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

        //显示参与人数
        $man_count=DB::table('event_members')->where(['events_id'=>$event->id])->count();

        //显示奖品
        $prizes=Prize::where('events_id',$event->id)->get();

        return view('events.show',compact('event','man_count','prizes'));
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

    //>>抽奖开奖=========重要
    public function kaijiang(Events $event){

        if(strtotime($event->prize_date) < time()){//开奖时间未到不能开奖
            session()->flash('success','开奖时间未到');
            return redirect()->route('events.index');
        }

        //找到所有报名人员
        $members=DB::table('event_members')->where('events_id',$event->id)->pluck('member_id')->shuffle();
        //找到所有奖品
        $prize=DB::table('enevt_prize')->where('events_id',$event->id)->pluck('id')->shuffle();

        //开始抽奖分配奖品
        $result=[];//保存抽奖结果
        foreach ($members as $member_id){
            $prize_id=$prize->pop();//从奖品数组中弹出一个奖品id
            if($prize==null) break;//当奖品取完时终止循环
            $result[$prize_id]=$member_id;
        }

        //将结果保存到数据库
        DB::transaction(function () use ($result,$event){
            foreach ( $result as $p_id=>$m_id){
                DB::table('enevt_prize')
                    ->where('id',$p_id)
                    ->update([
                        'member_id'=>$m_id,
                    ]);
            }

            //修改开奖状态为已开奖
//            $is_prize=$event->is_prize==1;
//            $event->update([
//                'is_prize'=>$is_prize
//            ]);

            $event->is_prize=1;
            $event->save();
            session()->flash('success','开奖成功');
        });


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
        $eventsUser=Event_Members::where('events_id',$event->id)->get();
//        var_dump($events);die;
        return view('events.events_user',compact('eventsUser'));
    }



}
