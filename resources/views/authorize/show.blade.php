@if ($title = "授权信息") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">用户资料</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form">

                            <div class="form-group">
                                <label for="max_connection" class="col-md-2 control-label">用户ID</label>
                                <div class="col-md-3">
                                    <input class="form-control" value="{{ $user['id'] or '' }}" readonly>
                                </div>
                                <label for="max_connection" class="col-md-2 control-label">用户名</label>

                                <div class="col-md-3">
                                    <input class="form-control" value="{{ $user['userName'] or '' }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="max_connection" class="col-md-2 control-label">姓名</label>

                                <div class="col-md-3">
                                    <input class="form-control" value="{{ $user['name'] or '' }}" readonly>
                                </div>
                                <label for="max_connection" class="col-md-2 control-label">邮箱</label>

                                <div class="col-md-3">
                                    <input class="form-control" value="{{ $user['email'] or '' }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="max_connection" class="col-md-2 control-label">办公电话</label>

                                <div class="col-md-3">
                                    <input class="form-control" value="{{ $user['officePhone'] or '' }}" readonly>
                                </div>
                                <label for="max_connection" class="col-md-2 control-label">手机</label>

                                <div class="col-md-3">
                                    <input class="form-control" value="{{ $user['phoneNo'] or '' }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="max_connection" class="col-md-2 control-label">部门</label>

                                <div class="col-md-8">
                                    <input class="form-control" value="@if(!empty($user['group']['orgid']))[{{$user['group']['orgid']}}] @endif{{ $user['group']['groupName'] or '' }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <a href="{{ URL('authorize') }}" type="reset" class="btn btn-default">
                                        <i class="fa fa-btn fa-reply"></i> 确定
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="panel-heading">授权信息</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form">

                            <div class="form-group">
                                @if ($user['userName']=='xtpadmin')
                                    <div class="col-md-3 col-md-offset-1">
                                        <label class="control-label text-success">
                                            <i class="fa fa-check-square-o"></i>
                                            XTP管理工具超级管理员
                                        </label>
                                    </div>
                                @endif
                                @if (!empty($user['permissions']))
                                    @foreach ($user['permissions'] as $item)
                                    <div class="col-md-3 col-md-offset-1">
                                        <label class="control-label @if ($item['status']!=1) text-danger @else text-success @endif">
                                            <i class="fa @if ($item['status']!=1) fa-close @else fa-check-square-o @endif"></i>
                                            @if ($item['permissionType']==1)
                                                XTP管理工具登录
                                            @else
                                                {{$item['name'] or ''}}
                                            @endif
                                        </label>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="col-md-2 col-md-offset-5 text-center">
                                        暂无授权
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>



                    <div class="panel-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
