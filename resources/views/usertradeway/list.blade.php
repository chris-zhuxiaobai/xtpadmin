@if ($title = "客户委托方式列表") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>

                    <div class="panel-body">
                        <form action="{{ URL("usertradeway") }}" method="GET" class="form-horizontal" role="form">
                            <div class="form-group">

                                <div class="col-md-2 ">
                                    <a href="{{ URL('usertradeway/create') }}" class="btn btn-default " name="action" value="search"><i class="fa fa-btn fa-plus"></i> 新加</a>
                                </div>
                            </div>
                        </form>
                    </div>


                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>客户帐号</th>
                            <th>资金帐号</th>
                            <th>委托方式</th>
                            <th>柜台委托方式</th>
                            <th>软件代码</th>
                            <th>软件版本前缀</th>
                            <th width="200px">　　</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!$usertradeways->isEmpty())
                            @foreach ($usertradeways as $i=>$item)
                                <tr>
                                    <td><a href="{{ url('usertradeway/'.$item->id) }}">{{ $item->id }}</a></td>
                                    <td>{{ $item->user->user_name or '' }}</td>
                                    <td>{{ $item->user->fundid or '' }}</td>
                                    <td>{{ $item->tradeway->name or '' }}</td>
                                    <td>{{ $item->tradeway->type1->name or '' }}[{{ $item->tradeway->type1->trade_way or '' }}]</td>
                                    <td>{{ $item->tradeway->type2->name or '' }}[{{ $item->tradeway->type2->trade_way or '' }}]</td>
                                    <td>{{ $item->tradeway->type3->name or '' }}[{{ $item->tradeway->type3->trade_way or '' }}]</td>
                                    <td>
                                        <a href="{{ url('usertradeway/'.$item->id) }}" class="btn btn-info" role="button">
                                            <span class="fa-stack">
                                                <i class="fa fa-info-circle"></i>
                                            </span>
                                            <span>详情</span>
                                        </a>
                                        <a href="{{ url('usertradeway/'.$item->id) }}" rel="nofollow" class="btn btn-danger btn-delete" role="button">
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

