@if ($title = "预开户名单详情") @endif
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
                                <label for="name" class="col-md-3 control-label">客户姓名</label>

                                <div class="col-md-8">
                                    <input value="{{ $white_list->name or '' }}" id="name" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="node_id" class="col-md-3 control-label">金证交易节点号</label>

                                <div class="col-md-8">
                                    <input value="{{ $white_list->node_id or '' }}" id="name" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="accountid" class="col-md-3 control-label">股东帐号</label>

                                <div class="col-md-8">
                                    <input value="{{ $white_list->accountid or '' }}" id="name" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="custid" class="col-md-3 control-label">客户代码</label>

                                <div class="col-md-8">
                                    <input value="{{ $white_list->custid or '' }}" id="custid" class="form-control" readonly>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fundid" class="col-md-3 control-label">资金帐号</label>

                                <div class="col-md-8">
                                    <input value="{{ $white_list->fundid or '' }}" id="fundid" class="form-control" readonly>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fundid" class="col-md-3 control-label">最大连接数</label>

                                <div class="col-md-8">
                                    <input value="{{ $white_list->max_connection or '' }}" id="max_connection" class="form-control" readonly>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="orgid" class="col-md-3 control-label">营业部</label>

                                <div class="col-md-8">
                                    <input value="({{ $white_list->org->orgid or '' }}) {{ $white_list->org->orgname or '' }}" id="orgid" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="bind_oms" class="col-md-3 control-label">绑定的交易服务</label>

                                <div class="col-md-8">
                                    <input id="bind_oms" value="{{ $white_list->trade->server_name or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="bind_oms" class="col-md-3 control-label">绑定的行情服务</label>

                                <div class="col-md-8">
                                    <input id="bind_oms" value="{{ $white_list->quote->server_name or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="bind_oms" class="col-md-3 control-label">绑定的交易方式</label>

                                <div class="col-md-8">
                                    <input id="bind_oms" value="{{ $white_list->trade_way->name or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-5">
                                    <a href="{{ URL('whitelist') }}" type="reset" class="btn btn-primary">
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