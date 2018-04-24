@if ($title = "个人信息") @endif
@if ($user = Auth::user()) @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>

                    <div class="panel-body">
                    </div>

                    <form class="form-horizontal" role="form">

                        @if (isset($user['id']))
                        <div class="form-group">
                            <label for="max_connection" class="col-md-3 control-label">用户ID</label>

                            <div class="col-md-8">
                                <input class="form-control" value="{{ $user['id'] or '' }}" readonly>
                            </div>
                        </div>
                        @endif

                        @if (isset($user['username']))
                        <div class="form-group">
                            <label for="max_connection" class="col-md-3 control-label">用户名</label>

                            <div class="col-md-8">
                                <input class="form-control" value="{{ $user['username'] or '' }}" readonly>
                            </div>
                        </div>
                        @endif

                        @if (isset($user['name']))
                            <div class="form-group">
                                <label for="max_connection" class="col-md-3 control-label">姓名</label>

                                <div class="col-md-8">
                                    <input class="form-control" value="{{ $user['name'] or '' }}" readonly>
                                </div>
                            </div>
                        @endif

                        @if (isset($user['idcard']))
                        <div class="form-group">
                            <label for="max_connection" class="col-md-3 control-label">证件号码</label>

                            <div class="col-md-8">
                                <input class="form-control" value="{{ $user['idcard'] or '' }}" readonly>
                            </div>
                        </div>
                        @endif

                        @if (!empty($user['group']))
                            <div class="form-group">
                                <label for="max_connection" class="col-md-3 control-label">部门</label>

                                <div class="col-md-8">
                                    <input class="form-control" value="@if(!empty($user['group']['orgid']))[{{$user['group']['orgid']}}] @endif{{ $user['group']['groupName'] or '' }}" readonly>
                                </div>
                            </div>
                        @endif

                        @if (isset($user['officePhone']))
                            <div class="form-group">
                                <label for="max_connection" class="col-md-3 control-label">办公电话</label>

                                <div class="col-md-8">
                                    <input class="form-control" value="{{ $user['officePhone'] or '' }}" readonly>
                                </div>
                            </div>
                        @endif

                        @if (isset($user['mobile']))
                        <div class="form-group">
                            <label for="max_connection" class="col-md-3 control-label">手机</label>

                            <div class="col-md-8">
                                <input class="form-control" value="{{ $user['mobile'] or '' }}" readonly>
                            </div>
                        </div>
                        @endif

                        @if (isset($user['email']))
                        <div class="form-group">
                            <label for="max_connection" class="col-md-3 control-label">邮箱</label>

                            <div class="col-md-8">
                                <input class="form-control" value="{{ $user['email'] or '' }}" readonly>
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
