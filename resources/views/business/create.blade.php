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
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            swf: '/webuploader/Uploader.swf',

            // 文件接收服务端。
            server: '/upload',
            formData:{_token:'{{csrf_token()}}','file_dir':'public/category_img'},

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });

        // 监听上传成功实践
        uploader.on( 'uploadSuccess', function( file,response ) {
            var imgUrl=response.url;
            $("#imgx").attr('src',imgUrl);//回显图片
            $("#tj").val(imgUrl)//提交图片连接到隐藏框
        });

    </script>
@stop()
