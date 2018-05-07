@extends('layouts.default')
@section('title','管理员注册')
@section('content')

    <form enctype="multipart/form-data" method="POST" action="{{route('admin.store')}}" >
        <div class="row container-fluid" style="background-color: rgba(0,255,173,0.08);margin: 30px;">
            <div class="row container-fluid" style="margin-left: 15%; margin-top: 10px;">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="form-group">
                            <label for="kk">管理员名称</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="kk" placeholder="填写商家名称">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="kk">邮箱</label>
                            <input type="text" name="email" value="{{old('email')}}" class="form-control" id="kk" placeholder="邮箱">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="kk">密码</label>
                            <input type="text" name="password" value="{{old('password')}}" class="form-control" id="kk" placeholder="填写商家名称">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="kk">确认密码</label>
                            <input type="text" name="password_confirmation " class="form-control" id="kk" placeholder="确认密码">
                        </div>
                    </div>

                    <div class="checkbox">
                        @foreach($roles as $role)
                            <label>
                                <input name="role_id[]" type="checkbox" value="{{$role->id}}">
                                {{$role->display_name}}
                            </label>
                        @endforeach
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
@stop()
