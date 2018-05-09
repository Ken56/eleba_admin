@extends('layouts.default')
@section('title','平台后台添加')
@section('content')

    <form enctype="multipart/form-data" method="POST" action="{{route('shop.store')}}" >
        <div class="row container-fluid" style="background-color: rgba(0,255,173,0.08);margin: 30px;">
            <div class="row container-fluid" style="margin-left: 15%; margin-top: 10px;">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="form-group">
                            <label for="kk">商户昵称</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="kk" placeholder="商户昵称">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="kk">手机号码</label>
                            <input type="number" name="tel" value="{{old('tel')}}" class="form-control" id="kk" placeholder="手机号码">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="kk">填写邮箱</label>
                            <input type="text" name="email" value="{{old('email')}}" class="form-control" id="kk" placeholder="填写邮箱">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="kk">填写密码</label>
                            <input type="text" name="password" value="{{old('password')}}" class="form-control" id="kk" placeholder="填写商家名称">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="kk">店铺名称</label>
                            <input type="text" name="shop_name" value="{{old('shop_name')}}" class="form-control" id="kk" placeholder="填写商家名称">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="kk">店铺分类</label>
                            <select class="form-control" name="category_id">
                                @foreach($categorys as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="kk">起送金额</label>
                            <input type="text" name="start_send" value="50" class="form-control" id="kk" placeholder="填写商家名称">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="kk">配送金额</label>
                            <input type="text" name="send_cost" value="60" class="form-control" id="kk" placeholder="填写商家名称">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="kk">准时送达</label>
                            <label class="radio-inline">
                                <input type="radio" name="on_time" id="inlineRadio1" value="0"> 使用
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="on_time" id="inlineRadio2" value="1" checked> 不使用
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="kk">蜂鸟配送</label>
                            <label class="radio-inline">
                                <input type="radio" name="fengniao" id="inlineRadio1" value="0"> 使用
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="fengniao" id="inlineRadio2" value="1" checked> 不使用
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div id="uploader-demo" class="container-fluid">
                            <!--用来存放item-->
                            <div id="fileList" class="uploader-list"></div>
                            <div id="filePicker">选择图片</div>
                            <img src="" alt="" id="imgx" width="150px;" >
                            <input type="hidden" name="shop_img" value="" id="tj">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="kk">店铺公告</label>
                            <textarea class="form-control" rows="3" name="notice">请填写店铺公告</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="kk">优惠信息</label>
                            <textarea class="form-control" rows="3" name="discount">请填写优惠信息</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" value="提交">
                    </div>


                </div>
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
            formData:{_token:'{{csrf_token()}}','file_dir':'public/fenlei'},

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
