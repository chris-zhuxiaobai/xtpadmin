@if ($title = "委托方式类型列表") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>

                    <div class="panel-body">
                        <form action="{{ URL("tradewaytype") }}" method="GET" class="form-horizontal" role="form">
                            <div class="form-group">

                                <div class="col-md-2 ">
                                    <a href="{{ URL('tradewaytype/create') }}" class="btn btn-default " name="action" value="search"><i class="fa fa-btn fa-plus"></i> 新加</a>
                                </div>
                            </div>
                        </form>
                    </div>


                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>名称</th>
                            <th>类型</th>
                            <th>数值</th>
                            <th>状态</th>
                            <th width="200px">　　</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!$tradeway_types->isEmpty())
                            @foreach ($tradeway_types as $i=>$item)
                                <tr>
                                    <td><a href="{{ URL('tradewaytype/'.$item->id) }}">{{ $item->id or '' }}</a></td>
                                    <td>{{ $item->name or '' }}</td>
                                    <td>{{ $item->type==1?'集中交易柜台委托方式':($item->type==2?'软件代码':'软件版本前缀') }}</td>
                                    <td>{{ $item->trade_way or '' }}</td>
                                    <td>{{ $item->status == 0? '正常':'异常'}}</td>
                                    <td>
                                        <a href="{{ url('tradewaytype/'.$item->id.'/edit') }}" class="btn btn-primary" role="button">
                                            <span class="fa-stack">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                            <span>编辑</span>
                                        </a>

                                        <a href="{{ url('tradewaytype/'.$item->id) }}" rel="nofollow" class="btn btn-danger btn-delete" role="button">
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
            </div>
        </div>
    </div>
@endsection

