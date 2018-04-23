<!--导航栏-->
<nav class="navbar navbar-default">
    <div class="container-fluid">

        <!-- 登录按钮 -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="./Uploads/favicon.ico" width="20px;" alt=""></a>
            <a class="navbar-brand" href="">平台管理系统</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{route('shop.index')}}"><span class="glyphicon glyphicon-tint
"></span>商家管理</a></li>
                <li class="dropdown">
                <li><a href=""><span class="glyphicon glyphicon-tint
"></span>分类管理</a></li>
                <li class="active"><a href=""><span class="glyphicon glyphicon-star-empty"></span>消费记录 <span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-time
"></span>时间 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">菜单一</a></li>
                        <li><a href="#">菜单二</a></li>
                        <li><a href="#">菜单三</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">特列一</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">特列二</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left" action="" method="get">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="搜索" name="keyword">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @guest
                <li><a href="{{route('admin.create')}}">管理员注册</a></li>
                <li><a href="{{route('login')}}">登录</a></li>
                @endguest
                @auth
                <li><img class="img-thumbnail" width="70px;" src="" alt=""></li>
                <li class="dropdown">
                    <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li data-toggle="modal" data-target="#login" id="login_name">
                            <a href="{{route('updatepwd')}}">修改密码</a>
                        </li>
                        <li data-toggle="modal" data-target="#login" id="login_name">
                            <form action="{{route('logout')}}" method="post">
                                <button class="btn btn-link">注销</button>
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                            </form>
                        </li>

                    </ul>
                </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>