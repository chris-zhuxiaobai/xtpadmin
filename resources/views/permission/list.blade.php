@if ($title = "权限列表") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>


                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>权限编号</th>
                            <th>权限名称</th>
                            <th>权限状态</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!empty($permission_lists))
                            @foreach ($permission_lists as $i=>$item)
                                <tr>
                                    <td>{{$item['id'] or ''}}</td>
                                    <td>{{$item['permissionName'] or ''}}</td>
                                    <td>{{$item['name'] or ''}}</td>
                                    <td>{{ $item['enabled']?'正常':'异常' }}</td>

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

