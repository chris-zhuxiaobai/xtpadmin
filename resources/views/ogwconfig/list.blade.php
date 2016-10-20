@if ($title = "报盘节点信息配置列表") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>

                    <div class="panel-body">
                        <form action="{{ URL("ogwconfig") }}" method="GET" class="form-horizontal" role="form">
                            <div class="form-group">

                                <div class="col-md-2 ">
                                    <a href="{{ URL('ogwconfig/create') }}" class="btn btn-default " name="action" value="search"><i class="fa fa-btn fa-plus"></i> 新加</a>
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
                            <th>报盘节点</th>
                            <th>pbu id</th>
                            <th width="200px">　　</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!$ogwconfig_lists->isEmpty())
                            @foreach ($ogwconfig_lists as $i=>$item)
                                <tr>
                                    <td><a href="{{ URL('ogwconfig/'.$item->id) }}">{{ $item->id or '' }}</a></td>
                                    <td>@if ($item->ogw) {{$item->ogw->sub_type==0?'上交所':'深交所'}} @else - @endif</td>
                                    <td>@if ($item->ogw) {{ $item->ogw->server_name or '' }} @else - @endif</td>
                                    <td>{{ $item->pbu_id or '' }}</td>
                                    <td>
                                        <a href="{{ url('ogwconfig/'.$item->id.'/edit') }}" class="btn btn-primary" role="button">
                                            <span class="fa-stack">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                            <span>编辑</span>
                                        </a>

                                        <a href="{{ url('ogwconfig/'.$item->id) }}" rel="nofollow" class="btn btn-danger btn-delete" role="button">
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
                {!! $ogwconfig_lists->render() !!}
            </div>
        </div>
    </div>
@endsection

