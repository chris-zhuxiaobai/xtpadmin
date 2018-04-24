@if ($title = "服务节点列表(第{$page}页)") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>

                    <div class="panel-body">
                        <form action="{{ URL("server") }}" method="GET" class="form-horizontal" role="form">
                            <div class="form-group">

                                <label for="filter_id" class="col-md-1 control-label"> 节点ID:</label>
                                <div class="col-md-1">
                                    <input type="text" id="filter_id" name="filter_id" class="form-control" value="{{$query['filter_id'] or ''}}">
                                </div>

                                <div class="col-md-2 ">
                                    <button class="btn btn-default " name="action" value="search"><i class="fa fa-btn fa-search"></i> 筛选</button>
                                    <a href="{{ URL('server/create') }}" class="btn btn-default " name="action" value="search"><i class="fa fa-btn fa-plus"></i> 新加</a>
                                </div>
                            </div>
                        </form>
                    </div>


                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>服务节点ID</th>
                            <th>服务节点名</th>
                            <th>最大连接数</th>
                            <th>IP地址</th>
                            <th>端口号</th>
                            <th>主/备</th>
                            <th>主类型</th>
                            <th>子类型</th>
                            <th>是否可用</th>
                            <th width="200px">　　</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!$server_lists->isEmpty())
                            @foreach ($server_lists as $i=>$item)
                                <tr>
                                    <td><a href="{{ URL('server/'.$item->id) }}">{{ $item->id or '' }}</a></td>
                                    <td><a href="{{ URL('server/'.$item->id) }}">{{ $item->server_name or '' }}</a></td>
                                    <td>{{ $item->max_connection or '' }}</td>
                                    <td>{{ $item->ip or '' }}</td>
                                    <td>{{ $item->port or '' }}</td>
                                    <td>{{ $item->status_type==0?'主':'备' }}</td>
                                    <td>{{ $server_types[$item->main_type][$item->sub_type]['main_type'] or '' }}</td>
                                    <td>{{ $server_types[$item->main_type][$item->sub_type]['sub_type'] or '' }}</td>
                                    <td>{{ $item->is_available==1?'可用':'不可用' }}</td>
                                    <td>
                                        <a href="{{ url('server/'.$item->id.'/edit') }}" class="btn btn-primary" role="button">
                                            <span class="fa-stack">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                            <span>编辑</span>
                                        </a>

                                        <a href="{{ url('server/'.$item->id) }}" rel="nofollow" class="btn btn-danger btn-delete" role="button">
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

                {!! $server_lists->render() !!}
            </div>
        </div>
    </div>
@endsection
