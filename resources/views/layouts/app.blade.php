<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@if (!empty($title)) {{$title}} - @endif XTP管理系统</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{url('css/app.css')}}" >
    <link rel="stylesheet" href="{{url('css/fx.css')}}" >

</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">导航</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('') }}">
                    XTP 管理系统
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                @if (!Auth::guest())
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{ url('home') }}">
                                <span class="fa-stack fa-lg">
                                  <i class="fa fa-square-o fa-stack-2x"></i>
                                  <i class="fa fa-home fa-stack-1x"></i>
                                </span>
                                首页
                            </a>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="fa-stack fa-lg">
                                  <i class="fa fa-square-o fa-stack-2x"></i>
                                  <i class="fa fa-cog fa-stack-1x"></i>
                                </span>
                                管理工具
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @if (!Gate::denies('enter', new \App\Orgs()))
                                    <li><a href="{{ url('org') }}"><i class="fa fa-btn fa-sitemap"></i> 营业部基本信息</a></li>
                                @endif
                                @if (!Gate::denies('enter', new \App\Branches()))
                                    <li><a href="{{ url('branche') }}"><i class="fa fa-btn fa-file-text"></i> 营业部合同号</a></li>
                                @endif
                                @if (!Gate::denies('enter', new \App\Servers()))
                                    <li><a href="{{ url('server') }}"><i class="fa fa-btn fa-server"></i> 服务节点管理</a></li>
                                @endif
                                @if (!Gate::denies('enter', new \App\OmsConfigs()))
                                    <li><a href="{{ url('omsconfig') }}"><i class="fa fa-btn fa-cubes"></i> 交易节点信息配置</a></li>
                                @endif
                                @if (!Gate::denies('enter', new \App\OgwConfigs()))
                                    <li><a href="{{ url('ogwconfig') }}"><i class="fa fa-btn fa-cubes"></i> 报盘节点信息配置</a></li>
                                @endif
                                @if (!Gate::denies('enter', new \App\OgwBranches()))
                                    <li><a href="{{ url('ogwbranche') }}"><i class="fa fa-btn fa-cubes"></i> 上交所报盘节点信息</a></li>
                                @endif
                                @if (!Gate::denies('enter', new \App\TradeWayTypes()))
                                    <li class="divider"></li>
                                    <li><a href="{{ url('tradewaytype') }}"><i class="fa fa-btn fa-list"></i> 委托方式类型管理</a></li>
                                @endif
                                @if (!Gate::denies('enter', new \App\TradeWays()))
                                    <li><a href="{{ url('tradeway') }}"><i class="fa fa-btn fa-road"></i> 委托方式管理</a></li>
                                @endif
                                @if (!Gate::denies('enter', new \App\UserTradeWays()))
                                    <li><a href="{{ url('usertradeway') }}"><i class="fa fa-btn fa-road"></i> 客户委托方式管理</a></li>
                                @endif
                                @if (!Gate::denies('enter', new \App\Whitelists()))
                                    <li><a href="{{ url('whitelist') }}"><i class="fa fa-btn fa-y-combinator"></i> 预开户管理</a></li>
                                @endif
                                {{--@if (!Gate::denies('enter', new \App\Permissions()))--}}
                                    {{--<li class="divider"></li>--}}
                                    {{--<li><a href="{{ url('permission') }}"><i class="fa fa-btn fa-shield"></i> 权限列表</a></li>--}}
                                {{--@endif--}}
                                {{--@if (!Gate::denies('enter', new \App\Authorizes()))--}}
                                    {{--<li><a href="{{ url('authorize') }}"><i class="fa fa-btn fa-credit-card"></i> 授权管理</a></li>--}}
                                {{--@endif--}}
                                @if (!Gate::denies('enter', new \App\StockLimits()))
                                    <li class="divider"></li>
                                    <li><a href="{{ url('stocklimit') }}"><i class="fa fa-btn fa-minus-square"></i> 股票限制管理</a></li>
                                @endif
                                @if (!Gate::denies('enter', new \App\OpLogs()))
                                    <li><a href="{{ url('log') }}"><i class="fa fa-btn fa-calendar-plus-o"></i> 操作日志</a></li>
                                @endif
                            </ul>
                        </li>

                        <script language="JavaScript">
                            setTimeout(function(){
                                $('li.dropdown').each(function (i, li) {
                                    if ($(li).children('ul').children().length == 0){
                                        $(li).hide();
                                    }
                                });
                            },1);
                        </script>

                        @if (!Gate::denies('enter', new \App\Records()))
                        <li>
                            <a href="{{ url('record') }}">
                                <span class="fa-stack fa-lg">
                                  <i class="fa fa-square-o fa-stack-2x"></i>
                                  <i class="fa fa-bars fa-stack-1x"></i>
                                </span>
                                委托记录
                            </a>
                        </li>
                        @endif

                        @if (!Gate::denies('enter', new \App\Users()))
                        <li>
                            <a href="{{ url('user') }}">
                                <span class="fa-stack fa-lg">
                                  <i class="fa fa-square-o fa-stack-2x"></i>
                                  <i class="fa fa-users fa-stack-1x"></i>
                                </span>
                                客户列表
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('user/create') }}">
                                <span class="fa-stack fa-lg">
                                  <i class="fa fa-circle fa-stack-2x text-success"></i>
                                  <i class="fa fa-user-plus fa-stack-1x fa-inverse"></i>
                                </span>
                                开户
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('user/destroy/home') }}">
                                <span class="fa-stack fa-lg">
                                  <i class="fa fa-user-times fa-stack-1x"></i>
                                  <i class="fa fa-ban fa-stack-2x text-danger"></i>
                                </span>
                                销户
                            </a>
                        </li>
                    @endif
                    </ul>
                @endif

                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (!Auth::guest())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                                <span class="fa-stack fa-lg">
                                  <i class="fa fa-square-o fa-stack-2x"></i>
                                  <i class="fa fa-male fa-stack-1x"></i>
                                </span>
                                {{ Auth::user()->name }} <span class="caret"></span>

                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('account') }}"><i class="fa fa-btn fa-user"></i> 个人信息</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ url('auth/logout') }}"><i class="fa fa-btn fa-sign-out"></i> 退出</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ url('auth/login') }}"><i class="fa fa-btn fa-street-view"></i> 登录</a></li>
                    @endif
                        {{--<li>--}}
                            {{--<a class="top-timer"></a>--}}
                            {{--<script language="javascript">var t={{ time() * 1000 }}; var f=function(){--}}
                                    {{--t += 1000; var d = new Date(t);  var h= d.toLocaleString(); $('.top-timer').html(h);--}}
                                {{--}; setInterval(f, 1000);</script>--}}
                        {{--</li>--}}
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <nav id="footer">
        <div class="container">
            <div class="col-md-4 col-md-offset-5">
                <p class="text-muted credit">&copy; copyright XTP 2016</p>
             </div>
        </div>
    </nav>

    <!-- JavaScripts -->
    <script src="{{url('js/app.js')}}"></script>
</body>
</html>
