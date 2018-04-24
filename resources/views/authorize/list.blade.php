@if ($title = "授权列表") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>

                    <div class="panel-body">
                        <form action="{{ URL("authorize") }}" method="GET" class="form-horizontal" role="form">
                            <div class="form-group">

                                <div class="col-md-2 ">
                                    <a href="{{ URL('authorize/create') }}" class="btn btn-default " name="action" value="search"><i class="fa fa-btn fa-plus"></i> 新加</a>
                                </div>
                            </div>
                        </form>
                    </div>


                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>帐号</th>
                            <th>姓名</th>
                            <th>邮箱</th>
                            <th width="120px">　　</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!empty($authorize_lists))
                            @foreach ($authorize_lists as $i=>$item)
                                <tr>
                                    <td><a href="{{ URL('authorize/'.$item['id']) }}">{{ $item['id'] or '' }}</a></td>
                                    <td>{{ $item['userName'] or '' }}</td>
                                    <td>
                                        @if ($item['gender']==1)
                                        <i class="fa fa-male"></i>
                                        @elseif($item['gender']==2)
                                            <i class="fa fa-female"></i>
                                        @endif
                                        <span>{{ $item['name'] or '' }}</span></td>
                                    <td>{{ $item['email'] or '' }}</td>

                                    <td>
                                        <a href="{{ url('authorize/'.$item['id'].'/edit') }}" class="btn btn-primary" role="button">
                                            <span class="fa-stack">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                            <span>编辑</span>
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

