@if ($title = "交易节点信息配置列表") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>

                    <div class="panel-body">
                        <form action="{{ URL("omsconfig") }}" method="GET" class="form-horizontal" role="form">
                            <div class="form-group">

                                <div class="col-md-2 ">
                                    <a href="{{ URL('omsconfig/create') }}" class="btn btn-default " name="action" value="search"><i class="fa fa-btn fa-plus"></i> 新加</a>
                                </div>
                            </div>
                        </form>
                    </div>


                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>交易节点</th>
                            <th>报盘节点(上交所)</th>
                            <th>报盘节点(深交所)</th>
                            <th width="200px">　　</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!$omsconfig_lists->isEmpty())
                            @foreach ($omsconfig_lists as $i=>$item)
                                <tr>
                                    <td><a href="{{ URL('omsconfig/'.$item->id) }}">{{ $item->id or '' }}</a></td>
                                    <td>{{ $item->oms->server_name or '' }}</td>
                                    <td>{{ $item->ogw_sh->server_name or '' }}</td>
                                    <td>{{ $item->ogw_sz->server_name or '' }}</td>
                                    <td>
                                        <a href="{{ url('omsconfig/'.$item->id.'/edit') }}" class="btn btn-primary" role="button">
                                            <span class="fa-stack">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                            <span>编辑</span>
                                        </a>

                                        <a href="{{ url('omsconfig/'.$item->id) }}" rel="nofollow" class="btn btn-danger btn-delete" role="button">
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
                {!! $omsconfig_lists->render() !!}
            </div>
        </div>
    </div>
@endsection

