@extends('layouts.default')
@section('title','商家分类管理')
@section('content')
    <div class="container-fluid">
        <table class="table table-bordered container-fluid" style="text-align: center" id="jsx">
            <tr>
                <td>ID</td>
                <td>商家名字</td>
                <td>商家电话</td>
            </tr>
            @foreach($eventsUser as $val)
                <tr data-id="{{ $val->id }}">
                    <td>{{$val->id}}</td>
                    <td>{{$val->user->name}}</td>
                    <td>{{$val->user->tel}}</td>
                </tr>
            @endforeach
        </table>
        <a href="{{route('events.index')}}" class="btn btn-primary">返回</a>
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

