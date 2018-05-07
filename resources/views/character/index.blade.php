@extends('layouts.default')
@section('title','角色列表管理')
@section('content')
    <div class="container-fluid">
        <table class="table table-bordered container-fluid" style="text-align: center" id="jsx">
            <tr>
                <td><a href="{{route('character.create')}}" class="btn btn-info">添加权限</a></td>
            </tr>
            <tr>
                <td>权限ID</td>
                <td>名称</td>
                <td>显示名称</td>
                <td>描述</td>
                <td>操作</td>
            </tr>
            @foreach($characters as $character)
            <tr data-id="{{ $character->id }}">
                <td>{{$character->id}}</td>
                <td>{{$character->name}}</td>
                <td>{{$character->display_name}}</td>
                <td>{{$character->description}}</td>
                <td>
                    <a href="{{route('character.edit',['character'=>$character])}}" class="btn btn-warning">编辑</a>
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
                    url: 'character/'+id,
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

