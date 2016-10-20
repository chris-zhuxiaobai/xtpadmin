@if ($title = "用户详情") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form">

                            <div class="form-group">
                                <label for="user_name" class="col-md-3 control-label">登录帐号</label>

                                <div class="col-md-8">
                                    <input value="{{ $user->user_name or '' }}" class="form-control" readonly>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="custid" class="col-md-3 control-label">客户代码</label>

                                <div class="col-md-8">
                                    <input value="{{ $user->custid or '' }}" class="form-control" readonly>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fundid" class="col-md-3 control-label">资金帐号</label>

                                <div class="col-md-8">
                                    <input value="{{ $user->fundid or '' }}" class="form-control" readonly>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user_type" class="col-md-3 control-label">用户类型</label>

                                <div class="col-md-8">
                                    <input value="@if (count($user->userType()->where('main_type', 3)->get())){{$user->userType()->where('main_type', 3)->get()[0]->sub_type_str}}@endif" class="form-control" readonly>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="quote_server" class="col-md-3 control-label">行情服务器</label>

                                <div class="col-md-8">
                                    <input value="{{ $user->quoteServer->server_name or '' }}" class="form-control" readonly>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="trade_server" class="col-md-3 control-label">交易服务器</label>

                                <div class="col-md-8">
                                    <input value="{{ $user->tradeServer->server_name or '' }}" class="form-control" readonly>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-5">
                                    <a href="{{ URL('user') }}" type="reset" class="btn btn-primary">
                                        <i class="fa fa-btn fa-reply"></i> 确定
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection