@if ($title = "操作日志") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}} (第{{$page}}页)</div>

                    <div class="panel-body">
                        <form action="{{ URL("log") }}" method="GET" class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="filter_id" class="col-md-1 control-label"> ID:</label>
                                <div class="col-md-1">
                                    <input type="text" id="filter_id" name="filter_id" class="form-control" value="{{$query['filter_id'] or ''}}">
                                </div>

                                <label for="filter_username" class="col-md-1 control-label"> 帐号:</label>
                                <div class="col-md-2">
                                    <input type="text" id="filter_username" name="filter_username" class="form-control" value="{{$query['filter_username'] or ''}}">
                                </div>

                                <label for="filter_controller" class="col-md-1 control-label"> 模块:</label>
                                <div class="col-md-2">
                                    <select name="filter_controller" id="filter_controller" class="form-control select" >
                                        <option value="" > ---请选择--- </option>
                                        <option value="Default" @if (isset($query['filter_controller']) && $query['filter_controller'] == "Default") selected @endif>首页(未登录)</option>
                                        <option value="Home" @if (isset($query['filter_controller']) && $query['filter_controller'] == "Home") selected @endif>首页</option>
                                        <option value="Auth\Auth" @if (isset($query['filter_controller']) && $query['filter_controller'] == "Auth\Auth") selected @endif>登录</option>
                                        <option value="Account" @if (isset($query['filter_controller']) && $query['filter_controller'] == "Account") selected @endif>个人资料</option>
                                        <option value="User" @if (isset($query['filter_controller']) && $query['filter_controller'] == "User") selected @endif>客户管理</option>
                                        <option value="Record" @if (isset($query['filter_controller']) && $query['filter_controller'] == "Record") selected @endif>委托记录</option>
                                        <option value="Server" @if (isset($query['filter_controller']) && $query['filter_controller'] == "Server") selected @endif>服务器管理</option>
                                        <option value="Org" @if (isset($query['filter_controller']) && $query['filter_controller'] == "Org") selected @endif>客户管理</option>
                                        <option value="Branche" @if (isset($query['filter_controller']) && $query['filter_controller'] == "Branche") selected @endif>合同号管理</option>
                                        <option value="StockLimit" @if (isset($query['filter_controller']) && $query['filter_controller'] == "StockLimit") selected @endif>股票限制管理</option>
                                        <option value="TradeWay" @if (isset($query['filter_controller']) && $query['filter_controller'] == "TradeWay") selected @endif>委托方式管理</option>
                                        <option value="TradeWayType" @if (isset($query['filter_controller']) && $query['filter_controller'] == "TradeWayType") selected @endif>委托方式类型管理</option>
                                        <option value="WhiteList" @if (isset($query['filter_controller']) && $query['filter_controller'] == "WhiteList") selected @endif>预开户管理</option>

                                    </select>
                                </div>

                                <label for="filter_action" class="col-md-1 control-label"> 动作:</label>
                                <div class="col-md-2">
                                    <select name="filter_action" id="filter_action" class="form-control select" >
                                        <option value="" > ---请选择--- </option>
                                        <option value="index" @if (isset($query['filter_action']) && $query['filter_action'] == "index") selected @endif>显示列表页</option>
                                        <option value="show" @if (isset($query['filter_action']) && $query['filter_action'] == "show") selected @endif>显示详情页</option>
                                        <option value="create" @if (isset($query['filter_action']) && $query['filter_action'] == "create") selected @endif>显示新建页</option>
                                        <option value="store" @if (isset($query['filter_action']) && $query['filter_action'] == "store") selected @endif>保存新建项</option>
                                        <option value="edit" @if (isset($query['filter_action']) && $query['filter_action'] == "edit") selected @endif>显示修改页</option>
                                        <option value="update" @if (isset($query['filter_action']) && $query['filter_action'] == "update") selected @endif>保存修改项</option>
                                        <option value="destroy" @if (isset($query['filter_action']) && $query['filter_action'] == "destroy") selected @endif>删除项</option>
                                        <option value="getLogin" @if (isset($query['filter_action']) && $query['filter_action'] == "getLogin") selected @endif>登录</option>
                                        <option value="getLogout" @if (isset($query['filter_action']) && $query['filter_action'] == "getLogout") selected @endif>退出</option>
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">

                                <label for="filter_begin_date" class="col-md-1 control-label"> 时间段:</label>
                                <div class="col-md-3">
                                    <input type="datetime-local" id="filter_begin_date" name="filter_begin_date" class="form-control" value="{{$query['filter_begin_date'] or ''}}">
                                </div>

                                <div class="col-md-3">
                                    <input type="datetime-local" id="filter_end_date" name="filter_end_date" class="form-control" value="{{$query['filter_end_date'] or ''}}">
                                </div>

                                <div class="col-md-2 ">
                                    <button class="btn btn-default " name="action" value="search"><i class="fa fa-btn fa-search"></i> 筛选</button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>帐号</th>
                            <th width="100px">模块</th>
                            <th width="120px">操作</th>
                            <th>IP</th>
                            <th>用户标识</th>
                            <th >时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!$log_lists->isEmpty())
                            @foreach ($log_lists as $i=>$item)
                                @if ($item->controller = substr($item->controller, 1+strrpos($item->controller, '\\'))) @endif
                                @if ($item->controller = str_replace('Controller','',$item->controller)) @endif
                                @if ($item->env = json_decode($item->env)) @endif
                                <tr>
                                    <td>{{ $item->id or '' }}</td>
                                    <td>{{ $item->username or '(访客)' }}</td>
                                    <td>{{ Helpers::controllerStr($item->controller) }}</td>
                                    <td>{{ Helpers::actionTypesStr($item->action) }}</td>
                                    <td>{{ $item->env->REMOTE_ADDR or ''  }}:{{ $item->env->REMOTE_PORT or ''  }}</td>
                                    <td>{{ $item->env->HTTP_USER_AGENT or '' }}</td>
                                    <td>{{ $item->created_at }}</td>

                                </tr>

                            @endforeach
                        @else
                            <tr style="height: 300px;">
                                <td colspan="10" align="center">
                            <span>
                                暂无数据
                            </span>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

                {!! $log_lists->render() !!}
            </div>
        </div>
    </div>
@endsection
