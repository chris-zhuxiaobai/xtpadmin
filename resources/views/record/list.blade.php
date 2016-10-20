@if ($title = "委托记录流水(第{$page}页)") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14">
                <div class="panel panel-default">
                    <div class="panel-heading">委托记录流水({{$date}})</div>

                    <div class="panel-body">
                        <form action="{{ URL("record") }}" method="GET" class="form-horizontal" role="form">
                            <div class="form-group">

                                <label for="filter_rec_no" class="col-md-1 control-label"> 记录ID:</label>
                                <div class="col-md-1">
                                    <input type="text" id="filter_rec_no" name="filter_rec_no" class="form-control" value="{{$query['filter_rec_no'] or ''}}">
                                </div>

                                {{--<label for="filter_node_id" class="col-md-1 control-label"> 节点ID:</label>--}}
                                {{--<div class="col-md-1">--}}
                                    {{--<input type="text" id="filter_node_id" name="filter_node_id" class="form-control" value="{{$query['filter_node_id'] or ''}}">--}}
                                {{--</div>--}}

                                {{--<label for="filter_server_id" class="col-md-1 control-label"> 服务器ID:</label>--}}
                                {{--<div class="col-md-1">--}}
                                    {{--<input type="text" id="filter_server_id" name="filter_server_id" class="form-control" value="{{$query['filter_server_id'] or ''}}">--}}
                                {{--</div>--}}

                                <label for="filter_fund_id" class="col-md-1 control-label"> 资金帐号:</label>
                                <div class="col-md-2">
                                    <input type="text" id="filter_fund_id" name="filter_fund_id" class="form-control" value="{{$query['filter_fund_id'] or ''}}">
                                </div>

                                <label for="filter_stock_code" class="col-md-1 control-label"> 股票代码:</label>
                                <div class="col-md-2">
                                    <input type="text" id="filter_stock_code" name="filter_stock_code" class="form-control" value="{{$query['filter_stock_code'] or ''}}">
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
                            <th>记录ID</th>
                            <th>节点ID</th>
                            <th>交易节点</th>
                            <th>客户帐号</th>
                            <th>客户姓名</th>
                            <th>资金账户</th>
                            <th>证券代码</th>
                            <th align="right">委托价格</th>
                            <th>买卖类别</th>
                            <th>委托状态</th>
                            <th width="120px">　　</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!$record_lists->isEmpty())
                            @foreach ($record_lists as $i=>$item)
                                <tr>
                                    <td>{{ $item->RecNo or '' }}</td>
                                    <td>{{ $item->NodeID or '' }}</td>
                                    <td>{{ $item->oms->server_name or '' }}</td>
                                    <td>{{ $item->user->user_name or '' }}</td>
                                    <td>{{ $item->ClientName or '' }}</td>
                                    <td>{{ $item->FundAcc or '' }}</td>
                                    <td>{{ $item->StockName or '' }}({{ $item->StockCode or '' }})</td>
                                    <td align="right">{{ $item->OrderPrice or '' }}</td>
                                    <td>{{ Helpers::BSFlagStr($item->BSFlag) }}</td>
                                    <td>{{ Helpers::OrderStatusStr($item->OrdStatus)}}</td>
                                    <td>
                                        <a href="{{ url('record/'.$item->id) }}" class="btn btn-info" role="button">
                                            <span class="fa-stack">
                                                <i class="fa fa-info-circle"></i>
                                            </span>
                                            <span>详情</span>
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

                {!! $record_lists->render() !!}
            </div>
        </div>
    </div>
@endsection
