@if ($title = "营业部合同号列表") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>

                    <div class="panel-body">
                        <form action="{{ URL("branche") }}" method="GET" class="form-horizontal" role="form">
                            <div class="form-group">

                                <label for="filter_orgid" class="col-md-2 control-label"> 营业部代码:</label>
                                <div class="col-md-2">
                                    <input type="text" id="filter_orgid" name="filter_orgid" class="form-control" value="{{$query['filter_orgid'] or ''}}">
                                </div>

                                <label for="filter_node_id" class="col-md-2 control-label"> 柜台节点号:</label>
                                <div class="col-md-2">
                                    <input type="text" id="filter_node_id" name="filter_node_id" class="form-control" value="{{$query['filter_node_id'] or ''}}">
                                </div>

                                {{--<label for="filter_market" class="col-md-2 control-label"> 市场:</label>--}}
                                {{--<div class="col-md-2">--}}
                                    {{--<select name="filter_market" id="filter_market" class="form-control">--}}
                                        {{--<option value="">--请选择--</option>--}}
                                        {{--<option value="0" @if (isset($query['filter_market']) && $query['filter_market']=='0') selected @endif>深交所</option>--}}
                                        {{--<option value="1" @if (isset($query['filter_market']) && $query['filter_market']=='1') selected @endif>上交所</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}

                            </div>
                            <div class="form-group">

                                <label for="filter_prefix" class="col-md-2 control-label"> 合同号前缀:</label>
                                <div class="col-md-2">
                                    <input type="text" id="filter_prefix" name="filter_prefix" class="form-control" value="{{$query['filter_prefix'] or ''}}">
                                </div>

                                <label for="filter_mkt_branch_id" class="col-md-2 control-label"> 交易所合同号:</label>
                                <div class="col-md-2">
                                    <input type="text" id="filter_mkt_branch_id" name="filter_mkt_branch_id" class="form-control" value="{{$query['filter_mkt_branch_id'] or ''}}">
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
                            <th>营业部</th>
                            <th>金证柜台节点号</th>
                            <th>市场</th>
                            <th>合同号前缀</th>
                            <th>交易所合同号</th>
                            {{--<th width="200px">　　</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @if (!$branche_lists->isEmpty())
                            @if ($first_row = true) @endif
                            @if ($node_id = null) @endif
                            @if ($org_id = null) @endif
                            @foreach ($branche_lists as $i=>$item)
                                <tr>
                                @if ($org_id && $org_id==$item->org_id && $node_id && $node_id==$item->jzjy_node_id)
                                    @if ($first_row = false) @endif
                                @else
                                    @if ($first_row = true) @endif
                                @endif
                                @if ($first_row)
                                    @if ($node_id = $item->jzjy_node_id) @endif
                                    @if ($org_id = $item->org_id) @endif
                                    <td rowspan="2">[{{ $item->org->orgid or '' }}]{{ $item->org->orgname or '' }}</td>
                                    <td rowspan="2">{{ $item->jzjy_node_id or '' }}</td>
                                @endif
                                    <td>{{ $item->market==1?'上海':'深圳' }}</td>
                                    <td>{{ $item->prefix or '' }}</td>
                                    <td>{{ $item->mkt_branch_id or '' }}</td>
                                {{--@if ($first_row)--}}
                                    {{--<td rowspan="2">--}}
                                        {{--<a href="{{ url('branche/'.$item->id.'/edit') }}" class="btn btn-primary" role="button">--}}
                                        {{--<span class="fa-stack">--}}
                                            {{--<i class="fa fa-edit"></i>--}}
                                        {{--</span>--}}
                                            {{--<span>编辑</span>--}}
                                        {{--</a>--}}

                                        {{--<a href="{{ url('branche/'.$item->id) }}" rel="nofollow" class="btn btn-danger btn-delete" role="button">--}}
                                        {{--<span class="fa-stack">--}}
                                            {{--<i class="fa fa-remove"></i>--}}
                                        {{--</span>--}}
                                            {{--<span>删除</span>--}}
                                        {{--</a>--}}

                                    {{--</td>--}}
                                {{--@endif--}}

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

                {!! $branche_lists->render() !!}
            </div>
        </div>
    </div>
@endsection
