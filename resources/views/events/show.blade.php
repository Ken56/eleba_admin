@extends('layouts.default')
@section('title','查看抽奖')
@section('content')

    <div class="container">
        <div class="col-lg-8">


            <div>
                <h1>{{$event->title}}</h1>
            </div>
            <div>
                <h3>开奖日期</h3>
                <h4>{{$event->prize_date}}</h4>
            </div>
            <div>
                <h3>活动日期</h3>
                <h4>抽奖开始时间{{date('Y-m-d',$event->signup_start)}}-----抽奖结束时间{{date('Y-m-d',$event->signup_end)}}</h4>
            </div>
            <div>
                <h3>参与人数限制</h3>
                <h4>{{$event->signup_num}}人</h4>
            </div>
                <div>
                    <h3>已有报名人数</h3>
                    <h4>{{$man_count}}人</h4>
                </div>
            <div>
                <h3>开奖状态</h3>
                <h4>{{$event->is_prize==0?'未开奖':'已开奖'}}</h4>
            </div>
            <div>
                <h3>抽奖活动内容</h3>
                <h4>{!! $event->contentx !!}</h4>
            </div>
            <a href="{{route('events.index')}}" class="btn btn-primary">返回</a>
        </div>


        <div class="col-lg-4">
            @foreach($prizes as $prize)
                <div>
                    <h3>奖品名字</h3>
                    <h4>{{$prize->name}}</h4>
                </div>
                <div>
                    <h3>奖品详情</h3>
                    <h4>{{$prize->description}}</h4>
                    <br>
                    <a href="{{route('prize.edit',['prize'=>$prize])}}" class="btn btn-warning">编辑</a>
                    <br>
                    <br>
                    <form action="{{route('prize.destroy',['prize'=>$prize])}}" method="POST">
                        <button class="btn btn-danger" >删除</button>
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                    </form>

                </div>
            @endforeach

        </div>
    </div>

@stop()

@section('js')
    <script>
        $("#jsx .btn-danger").click(function(){
            //二次确认
            if(confirm('确认删除该数据吗?删除后不可恢复!')){
                var tr = $(this).closest('tr');
                var id = tr.data('id');
                $.ajax({
                    type: "DELETE",
                    url: 'prize/'+id,
                    data: '_token={{ csrf_token() }}',
                    success: function(msg){
                        tr.fadeOut();
                    }
                });
                $(this).closest("tr").remove();
            }
        });
    </script>
@stop()

