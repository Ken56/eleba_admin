@extends('layouts.default')
@section('title','管理员中心')
@section('content')
    <div class="container-fluid">
        <table class="table table-bordered container-fluid" style="text-align: center" id="jsx">
            <tr>
                <td><a href="{{route('admin.create')}}" class="btn btn-info">添加权限</a></td>
            </tr>
            <tr>
                <td>管理员ID</td>
                <td>管理员名称</td>
                <td>邮箱</td>
                <td>操作</td>
            </tr>
            @foreach($admins as $admin)
            <tr data-id="{{ $admin->id }}">
                <td>{{$admin->id}}</td>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td><a href="{{route('updatepwd',['admin'=>$admin])}}" class="btn btn-warning">编辑</a>
                    <button class="btn btn-danger" >删除</button>
                </td>
            </tr>
            @endforeach

        </table>
        {{--{{$activitys->appends($fenye)->links()}}--}}
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
                    url: 'admin/'+id,
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

