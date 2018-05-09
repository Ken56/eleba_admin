<?php
//奖品管理
namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Prize;
use Illuminate\Http\Request;

class PrizeController extends Controller
{
    //活动添加奖品
    public function create(){

        $events=Events::all();//下拉列表选择添加奖品的活动
        return view('prize.create',compact('events'));

    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
        ],[
            'name.required'=>'奖品名称不能为空',
            'description.required'=>'奖品详情不能为空',
        ]);
    Prize::create([
        'name'=>$request->name,
        'description'=>$request->description,
        'events_id'=>$request->events_id,
    ]);

        session()->flash('success','奖品添加成功');
        return redirect()->route('events.index');

    }

    //活动添加奖品
    public function edit(Prize $prize){

        $events=Events::all();//下拉列表选择添加奖品的活动
        return view('prize.edit',compact('events','prize'));

    }

    public function update(Request $request,Prize $prize){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
        ],[
            'name.required'=>'奖品名称不能为空',
            'description.required'=>'奖品详情不能为空',
        ]);
        $prize->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'events_id'=>$request->events_id,
        ]);

        session()->flash('success','奖品修改成功');
        return redirect()->route('events.index');

    }

//>>删除数据
    public function destroy (Prize $prize){
        session()->flash('success','删除成功');
        $prize->delete();
    }



}
