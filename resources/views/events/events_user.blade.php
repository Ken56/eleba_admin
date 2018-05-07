@extends('layouts.default')
@section('title','商家分类管理')
@section('content')
    <table class="table table-bordered container-fluid" style="text-align: center" id="jsx">
        <tr>
            <td><a href="{{route('shop.create')}}" class="btn btn-info">添加</a></td>
        </tr>
        <tr>
            <td>ID</td>
            <td>商家名字</td>
            <td>商家电话</td>
            <td>店铺详情</td>
            <td>审核状态</td>
            <td>操作
        </tr>
        @foreach($eventsUser as $val)
        <tr data-id="{{ $val->id }}">
            <td>{{$val->id}}</td>
            <td>{{$val->name}}</td>
            <td>{{$val->tel}}</td>
            <td><a href="{{route('shop.show',['shop'=>$val])}}">详情</a></td>
            <td>{{$val->status==1?'审核通过':'未审核通过'}}</td>
            <td>
                <a href="" class="btn btn-warning">修改</a>
                {{--<a href="{{route('delete',['category'=>$category])}}" class="btn btn-danger">删除</a>--}}
                <button class="btn btn-danger" >删除</button>
                <a href="{{route('status',['shop'=>$shop])}}" class="btn btn-success">{{$val->status==1?'审核不过':'审核通过'}}</a>
            </td>
        </tr>
        @endforeach
    </table>
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
                    url: 'shop/'+id,
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

