@extends('layouts.default')
@section('title','商家分类管理')
@section('content')
    <table class="table table-bordered container-fluid" style="text-align: center" id="jsx">
        <tr>
            <td><a href="{{route('category.create')}}" class="btn btn-info">添加</a></td>
        </tr>
        <tr>
            <td>ID</td>
            <td>商家图片</td>
            <td>商家分类</td>
            <td>操作
        </tr>
        @foreach($categorys as $category)
        <tr data-id="{{ $category->id }}">
            <td>{{$category->id}}</td>
            <td><img src="{{$category->img}}" width="70px;" class="img-thumbnail" alt=""></td>
            <td>{{$category->name}}</td>
            <td>
                <a href="{{route('category.edit',['category'=>$category])}}" class="btn btn-warning">编辑</a>
                {{--<a href="{{route('delete',['category'=>$category])}}" class="btn btn-danger">删除</a>--}}
                {{--<button class="btn btn-danger" >删除</button>--}}
            </td>
        </tr>
        @endforeach
    </table>
    {{$categorys->appends($fenye)->links()}}
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
                    url: 'category/'+id,
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

