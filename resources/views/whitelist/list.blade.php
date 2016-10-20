@if ($title = "预开户名单列表") @endif
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>

                    <div class="panel-body">
                    </div>

                    <div class="panel-body">
                        <form action="{{ URL("whitelist") }}" method="GET" class="form-horizontal" role="form">
                            <div class="form-group">

                                <label for="filter_id" class="col-md-1 control-label"> ID:</label>
                                <div class="col-md-1">
                                    <input type="text" id="filter_id" name="filter_id" class="form-control" value="{{$query['filter_id'] or ''}}">
                                </div>

                                <div class="col-md-2 ">
                                    <button class="btn btn-default " name="action" value="search"><i class="fa fa-btn fa-search"></i> 筛选</button>
                                    <a href="{{ URL('whitelist/create') }}" class="btn btn-default " name="action" value="search"><i class="fa fa-btn fa-plus"></i> 新加</a>
                                </div>
                            </div>
                        </form>
                    </div>


                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>客户姓名</th>
                            <th>资金帐号</th>
                            <th>营业部</th>
                            <th>绑定行情服务</th>
                            <th>绑定交易服务</th>
                            <th colspan="2">XTP委托方式</th>
                            <th>状态</th>
                            <th width="200px">　　</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!$white_lists->isEmpty())
                            @foreach ($white_lists as $i=>$item)
                                <tr>
                                    <td><a href="{{ URL('whitelist/'.$item->id) }}">{{ $item->id or '' }}</a></td>
                                    <td>{{ $item->name or '' }}</td>
                                    <td><a href="{{ URL('whitelist/'.$item->id) }}">{{ $item->fundid or '' }}</a></td>
                                    <td>{{ $item->org->orgname or '' }}</td>
                                    <td>{{ $item->quote->server_name or '' }}</td>
                                    <td>
                                        {{ $item->trade->server_name or '' }} <br>

                                    </td>
                                    <td>
                                        {{ $item->trade_way->name or '' }}
                                    </td>
                                    <td>
                                        <ul class="fa-ul">
                                            <li title="集中交易委托方式">
                                                <span>集中交易委托方式</span>
                                                <span> => </span>
                                                <span>{{ $item->trade_way->type1->trade_way or '' }}</span>
                                            </li>
                                            {{--<li title="软件代码">--}}
                                                {{--<span>{{ $item->trade_way->type2->name or '' }}</span>--}}
                                                {{--<span> => </span>--}}
                                                {{--<span>{{ $item->trade_way->type2->trade_way or '' }}</span>--}}
                                            {{--</li>--}}
                                            {{--<li title="软件版本前缀">--}}
                                                {{--<span>{{ $item->trade_way->type3->name or '' }}</span>--}}
                                                {{--<span> => </span>--}}
                                                {{--<span>{{ $item->trade_way->type3->trade_way or '' }}</span>--}}
                                            {{--</li>--}}
                                        </ul>
                                    </td>
                                    <td>{{ $item->status == 0? '正常':'已开户'}}</td>
                                    <td>
                                        <a href="{{ url('whitelist/'.$item->id.'/edit') }}" class="btn btn-primary" role="button">
                                            <span class="fa-stack">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                            <span>编辑</span>
                                        </a>

                                        <a href="{{ url('whitelist/'.$item->id) }}" rel="nofollow" class="btn btn-danger btn-delete" role="button">
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

                {!! $white_lists->render() !!}
            </div>
        </div>
    </div>
@endsection
