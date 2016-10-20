@if ($title = "用户列表") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>

                    <div class="panel-body">
                        <form action="{{ URL("user") }}" method="GET" class="form-horizontal" role="form">
                            <div class="form-group">

                                <label for="filter_user_name" class="col-md-1 control-label"> 用户名:</label>
                                <div class="col-md-2">
                                    <input type="text" id="filter_user_name" name="filter_user_name" class="form-control" value="{{$query['filter_user_name'] or ''}}">
                                </div>

                                <label for="filter_fundid" class="col-md-1 control-label"> 资金帐号:</label>
                                <div class="col-md-2">
                                    <input type="text" id="filter_fundid" name="filter_fundid" class="form-control" value="{{$query['filter_fundid'] or ''}}">
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
                            <th>客户代码</th>
                            <th>资金帐号</th>
                            <th>用户类型</th>
                            <th>行情服务器</th>
                            <th>交易服务器</th>
                            <th>最大连接数</th>
                            <th>状态</th>
                            <th width="120px">　　</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!$user_lists->isEmpty())
                            @foreach ($user_lists as $i=>$item)
                                <tr>
                                    <td><a href="{{ URL('user/'.$item->id) }}">{{ $item->id or '' }}</a></td>
                                    <td><a href="{{ URL('user/'.$item->id) }}">{{ $item->user_name or '' }}</a></td>
                                    <td>{{ $item->custid or '' }}</td>
                                    <td>{{ $item->fundid or '' }}</td>
                                    <td>
                                        @if (count($item->userType()->where('main_type', 3)->get()))
                                            {{$item->userType()->where('main_type', 3)->get()[0]->sub_type_str}}
                                        @endif

                                    </td>
                                    <td>{{ $item->quoteServer->server_name or '' }}</td>
                                    <td>{{ $item->tradeServer->server_name or '' }}</td>
                                    <td>{{ $item->max_connection or '' }}</td>
                                    <td>{{ $item->status == 0? '正常':'异常'}}</td>
                                    <td>
                                        <a href="{{ url('user/'.$item->id) }}" class="btn btn-primary" role="button">
                                            <span class="fa-stack">
                                                <i class="fa fa-info-circle"></i>
                                            </span>
                                            <span>详情</span>
                                        </a>
                                        </a>

                                    </td>

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

                {!! $user_lists->render() !!}
            </div>
        </div>
    </div>
@endsection

