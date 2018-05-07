@extends('layouts.default')
@section('title','权限列表管理')
@section('content')
    <div class="container-fluid">
        <table class="table table-bordered container-fluid" style="text-align: center" id="jsx">
            <tr>
                <td><a href="{{route('authority.create')}}" class="btn btn-info">添加权限</a></td>
            </tr>
            <tr>
                <td>权限ID</td>
                <td>名称</td>
                <td>显示名称</td>
                <td>描述</td>
                <td>操作</td>
            </tr>
            @foreach($authoritys as $authority)
            <tr data-id="{{ $authority->id }}">
                <td>{{$authority->id}}</td>
                <td>{{$authority->name}}</td>
                <td>{{$authority->display_name}}</td>
                <td>{{$authority->description}}</td>
                <td>
                    @role('superadmin')
                    <a href="{{route('authority.edit',['authority'=>$authority])}}" class="btn btn-warning">编辑</a>
                    @endrole
                    <button class="btn btn-danger" >删除</button>
                </td>
            </tr>
            @endforeach

        </table>
        {{$authoritys->links()}}
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
                    url: 'authority/'+id,
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

