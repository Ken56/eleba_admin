@extends('layouts.default')
@section('title','活动奖品修改')
@section('content')
    <div class="container">
        <div class="col-lg-2"></div>

        <div class="col-lg-8">
            <h1>活动奖品修改</h1><br>
            <form enctype="multipart/form-data" method="POST" action="{{route('prize.update',['prize'=>$prize])}}" >
                <div class="form-group">
                    <label for="kk">奖品名称</label>
                    <input type="text" name="name" value="{{$prize->name}}" class="form-control" id="kk" placeholder="奖品名称">
                </div>
                <div class="form-group">
                    <label for="kk">请选择活动</label>
                    <select class="form-control" name="events_id">
                        @foreach($events as $event)
                        <option selected {{$event->id==$prize->id?'selected':''}} value="{{$event->id}}">{{$event->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="kk">奖品详情</label>
                    <textarea class="form-control" rows="3" name="description">{{$prize->description}}</textarea>
                </div>
                <div class="">
                    <button type="submit" class="btn btn-default">提交</button>
                </div>
                {{csrf_field()}}
                {{method_field('PUT')}}
            </form>

        </div>


        <div class="col-lg-2"></div>
    </div>
@stop()

@section('js')
@stop()
