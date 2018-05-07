@extends('layouts.default')
@section('title','权限添加')
@section('content')
    <div class="container-fluid">

        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <form enctype="multipart/form-data" method="POST" action="{{route('authority.update',['authority'=>$authority])}}" >
                <div>
                    <label for="kk">权限名称</label>
                    <input type="text" name="name" value="{{$authority->name}}" class="form-control" id="kk" placeholder="权限名称">
                </div>
                <div>
                    <label for="kk">显示名称</label>
                    <input type="text" name="display_name" value="{{$authority->display_name}}" class="form-control" id="kk" placeholder="显示名称">
                </div>
                <div>
                    <label for="kk">描述</label>
                    <textarea class="form-control" rows="3" name="description" id="" cols="30" rows="10">{{$authority->description}}</textarea>
                </div>

                <br>
                <div>
                    <button type="submit" class="btn btn-default">提交</button>
                </div>
                {{csrf_field()}}
                {{method_field('PUT')}}
            </form>
        </div>
        <div class="col-lg-43"></div>


    </div>
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
