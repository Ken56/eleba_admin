@extends('layouts.default')
@section('title','商家分类管理')
@section('content')
    <form enctype="multipart/form-data" method="POST" action="{{route('category.store')}}" >
        <div class="row container-fluid">
            <div class="form-group col-lg-4">
                <label for="kk">填写商家名称</label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" id="kk" placeholder="填写商家名称">
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
    </form>
@stop()

@section('js')
@stop()
