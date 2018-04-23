@extends('layouts.default')
@section('title','商家分类修改')
@section('content')
    <form enctype="multipart/form-data" method="POST" action="{{route('category.update',['category'=>$category])}}" >
        <div class="row container-fluid">
            <div class="form-group col-lg-4">
                <label for="kk">填写商家名称</label>
                <input type="text" name="name" value="{{$category->name}}" class="form-control" id="kk" placeholder="填写商家名称">
            </div>
        </div>
        <div class="row container-fluid">
            <div class="form-group col-lg-12">
                <label for="kk">原图片:</label><br/>
                <img src="{{$category->img}}" alt="">
            </div>
        </div>
        <div class="row container-fluid">
            <div class="form-group col-lg-12">
                <label for="xx">上传图片</label>
                <input type="file" id="xx" name="img">
                <p class="help-block">需要上传文件</p>
            </div>
        </div>
        <div class="row container-fluid">
            <div class="col-lg-12">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    {{csrf_field()}}
    {{method_field('PUT')}}
    </form>
@stop()

@section('js')
@stop()
