@if ($title = "营业部列表") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>

                    <div class="panel-body">
                        <form action="{{ URL("org") }}" method="GET" class="form-horizontal" role="form">
                            <div class="form-group">

                                <label for="filter_org_id" class="col-md-2 control-label"> 营业部代码:</label>
                                <div class="col-md-2">
                                    <input type="text" id="filter_org_id" name="filter_org_id" class="form-control" value="{{$query['filter_org_id'] or ''}}">
                                </div>

                                <label for="filter_org_id" class="col-md-1 control-label"> 名称:</label>
                                <div class="col-md-2">
                                    <input type="text" id="filter_org_name" name="filter_org_name" class="form-control" value="{{$query['filter_org_name'] or ''}}">
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
                            <th>营业部代码</th>
                            <th>名称</th>
                            <th>状态</th>
                            <th width="120px">　　</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!$org_lists->isEmpty())
                            @foreach ($org_lists as $i=>$item)
                                <tr>
                                    <td><a href="{{ URL('org/'.$item->id) }}">{{ $item->id or '' }}</a></td>
                                    <td>{{ $item->orgid or '' }}</td>
                                    <td>{{ $item->orgname or '' }}</td>
                                    <td>{{ $item->status == 0? '正常':'异常'}}</td>
                                    <td>
                                        <a href="{{ url('org/'.$item->id) }}" class="btn btn-primary" role="button">
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

                {!! $org_lists->render() !!}
            </div>
        </div>
    </div>
@endsection

