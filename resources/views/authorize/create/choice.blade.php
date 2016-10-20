@if ($title = "授权 - 选择用户") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>

                    <div class="panel-body">
                        <!-- Table -->
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>帐号</th>
                                <th>姓名</th>
                                <th>邮箱</th>
                                <th>电话</th>
                                <th width="120px">　　</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (!empty($user_lists))
                                @foreach ($user_lists as $i=>$item)
                                    <tr>
                                        <td>{{ $item['id'] or '' }}</td>
                                        <td>{{ $item['userName'] or '' }}</td>
                                        <td>
                                            @if ($item['gender']==1)
                                                <i class="fa fa-male"></i>
                                            @elseif($item['gender']==2)
                                                <i class="fa fa-female"></i>
                                            @endif
                                            <span>{{ $item['name'] or '' }}</span></td>
                                        <td>{{ $item['email'] or '' }}</td>
                                        <td>{{ $item['officePhone'] or '' }}</td>

                                        <td>
                                            <a href="{{ url('authorize/create/auth/'.$item['id']) }}" class="btn btn-primary" role="button">
                                            <span class="fa-stack">
                                                <i class="fa fa-check"></i>
                                            </span>
                                                <span>选择</span>
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

                        <div class="form-group">
                            <div class="col-md-2">
                                <a href="{{ URL('authorize/create') }}" type="reset" class="btn btn-default">
                                    <i class="fa fa-btn fa-reply"></i> 取消
                                </a>
                            </div>
                        </div>
                    </div>



                    <div class="panel-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
