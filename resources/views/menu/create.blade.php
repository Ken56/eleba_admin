@extends('layouts.default')
@section('title','菜单添加')
@section('content')
    <div class="container-fluid">

        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <form enctype="multipart/form-data" method="POST" action="{{route('menu.store')}}" >
                <div>
                    <label for="kk">菜单名称</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="kk" placeholder="权限名称">
                </div>
                <div>
                    <label for="kk">上级菜单</label>
                    <select class="form-control" name="parent_id">
                        <option value="0">顶级菜单</option>
                        @foreach($menumanagements as $menumanagement)
                            <option value="{{$menumanagement->id}}">{{$menumanagement->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="kk">选择路由</label>
                    <input type="text" name="menu_route" value="{{old('menu_route')}}" class="form-control" id="kk" placeholder="选择路由">
                </div>
                <div>
                    <label for="kk">排序</label>
                    <input type="text" name="sorting" value="{{old('sorting')}}" class="form-control" id="kk" placeholder="权限名称">
                </div>

                <br>
                <div>
                    <button type="submit" class="btn btn-default">提交</button>
                </div>
                {{csrf_field()}}
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
