@if ($title = "上交所报盘节点列表") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>

                    <div class="panel-body">
                        <form action="{{ URL("ogwbranche") }}" method="GET" class="form-horizontal" role="form">
                            <div class="form-group">

                                <div class="col-md-2 ">
                                    <a href="{{ URL('ogwbranche/create') }}" class="btn btn-default " name="action" value="search"><i class="fa fa-btn fa-plus"></i> 新加</a>
                                </div>
                            </div>
                        </form>
                    </div>


                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>报盘节点</th>
                            <th>合同号前缀</th>
                            <th>合同号范围</th>
                            <th width="200px">　　</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!$ogwbranche_lists->isEmpty())
                            @foreach ($ogwbranche_lists as $i=>$item)
                                <tr>
                                    <td><a href="{{ URL('ogwbranche/'.$item->id) }}">{{ $item->id or '' }}</a></td>
                                    <td>{{ $item->ogw->server_name or '' }}</td>
                                    <td>{{ $item->branch_prefix or '' }}</td>
                                    <td>
                                        @if ($item->is_whole)
                                            全部
                                        @else
                                            {{ $item->sno_start }} - {{ $item->sno_end }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('ogwbranche/'.$item->id.'/edit') }}" class="btn btn-primary" role="button">
                                            <span class="fa-stack">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                            <span>编辑</span>
                                        </a>

                                        <a href="{{ url('ogwbranche/'.$item->id) }}" rel="nofollow" class="btn btn-danger btn-delete" role="button">
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
                {!! $ogwbranche_lists->render() !!}
            </div>
        </div>
    </div>
@endsection

