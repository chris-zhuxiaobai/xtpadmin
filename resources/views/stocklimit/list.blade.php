@if ($title = "股票限制列表") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>

                    <div class="panel-body">
                        <form action="{{ URL("stocklimit") }}" method="GET" class="form-horizontal" role="form">
                            <div class="form-group">

                                <label for="filter_stock_code" class="col-md-1 control-label"> 股票代码:</label>
                                <div class="col-md-2">
                                    <input type="text" id="filter_stock_code" name="filter_stock_code" class="form-control" value="{{$query['filter_stock_code'] or ''}}">
                                </div>

                                <div class="col-md-2 ">
                                    <button class="btn btn-default " name="action" value="search"><i class="fa fa-btn fa-search"></i> 筛选</button>
                                    <a href="{{ URL('stocklimit/create') }}" class="btn btn-default " name="action" value="search"><i class="fa fa-btn fa-plus"></i> 新加</a>
                                </div>

                            </div>
                        </form>
                    </div>


                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>交易所</th>
                            <th>股票代码</th>
                            <th>买入上下限</th>
                            <th>卖出上下限</th>
                            <th>起始日期</th>
                            <th>结束日期</th>
                            <th width="200px">　　</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!$stocklimit_lists->isEmpty())
                            @foreach ($stocklimit_lists as $i=>$item)
                                <tr>
                                    <td><a href="{{ URL('stocklimit/'.$item->id) }}">{{ $item->id or '' }}</a></td>
                                    <td>{{ $item->exch_id==1?'上交所':'深交所' }}</td>
                                    <td>{{ $item->ticker or '' }}</td>
                                    <td>{{ $item->buy_qty_lower_limit==-1?'不限':$item->buy_qty_lower_limit }}/{{ $item->buy_qty_upper_limit==-1?'不限':$item->buy_qty_upper_limit }}</td>
                                    <td>{{ $item->sell_qty_lower_limit==-1?'不限':$item->sell_qty_lower_limit }}/{{ $item->sell_qty_upper_limit==-1?'不限':$item->sell_qty_upper_limit }}</td>
                                    <td>{{ $item->start_day or '' }}</td>
                                    <td>{{ $item->end_day or '' }}</td>
                                    <td>
                                        <a href="{{ url('stocklimit/'.$item->id.'/edit') }}" class="btn btn-primary" role="button">
                                            <span class="fa-stack">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                            <span>编辑</span>
                                        </a>

                                        <a href="{{ url('stocklimit/'.$item->id) }}" rel="nofollow" class="btn btn-danger btn-delete" role="button">
                                            <span class="fa-stack">
                                                <i class="fa fa-remove"></i>
                                            </span>
                                            <span>删除</span>
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

                {!! $stocklimit_lists->render() !!}
            </div>
        </div>
    </div>
@endsection
