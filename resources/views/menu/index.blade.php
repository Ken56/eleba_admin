@extends('layouts.default')
@section('title','菜单管理')
@section('content')
    <div class="container-fluid">
        <table class="table table-bordered container-fluid" style="text-align: center" id="jsx">
            <tr>
                <td><a href="{{route('menu.create')}}" class="btn btn-info">添加菜单</a></td>
            </tr>
            <tr>
                <td>ID</td>
                <td>菜单名称</td>
                <td>上线删除父ID</td>
                <td>父级菜单</td>
                <td>路由</td>
                <td>排序</td>
                <td>操作</td>
            </tr>
            @foreach($menuManagements as $menuManagement)
            <tr data-id="{{ $menuManagement->id }}">
                <td>{{$menuManagement->id}}</td>
                <td>{{$menuManagement->name}}</td>
                <td>{{$menuManagement->parent_id}}</td>
                <td>{{$menuManagement->pid_name}}</td>
                <td>{{$menuManagement->menu_route}}</td>
                <td>{{$menuManagement->sorting}}</td>
                <td><a href="{{route('menu.edit',compact('menuManagement'))}}" class="btn btn-warning">编辑</a>
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
                    url: 'menu/'+id,
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

