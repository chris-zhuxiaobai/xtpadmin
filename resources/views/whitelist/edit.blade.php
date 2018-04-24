@if ($title = "预开户名单编辑") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>
                    <div class="panel-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>出错了!</strong><br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('whitelist/'.$white_list->id) }}">
                            <input name="_method" type="hidden" value="PUT">

                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">客户姓名</label>

                                <div class="col-md-8">
                                    <input type="text" name="name" value="{{ old('name',$white_list->name) }}" id="name" class="form-control">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('orgid') ? ' has-error' : '' }}">
                                <label for="orgid" class="col-md-3 control-label">营业部</label>

                                <div class="col-md-8">
                                    <select name="orgid" id="orgid" class="form-control select" >
                                        <option value="" > ---请选择--- </option>
                                        @foreach($org_lists as $row)
                                            <option value="{{ old('orgid',$row->orgid) }}" @if ($row->orgid==$white_list->orgid) selected @endif>({{$row->orgid}}){{$row->orgname}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('orgid'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('orgid') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('node_id') ? ' has-error' : '' }}">
                                <label for="node_id" class="col-md-3 control-label">金证交易节点</label>

                                <div class="col-md-8">
                                    <input type="text" name="node_id" value="{{ old('node_id',$white_list->node_id) }}" id="node_id" class="form-control">

                                    @if ($errors->has('node_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('node_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('accountid') ? ' has-error' : '' }}">
                                <label for="accountid" class="col-md-3 control-label">上交所股东帐号</label>

                                <div class="col-md-8">
                                    <input type="text" name="accountid" value="{{ old('accountid',$white_list->accountid) }}" id="accountid" class="form-control">

                                    @if ($errors->has('node_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('accountid') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('custid') ? ' has-error' : '' }}">
                                <label for="custid" class="col-md-3 control-label">客户代码</label>

                                <div class="col-md-8">
                                    <input type="text" name="custid" value="{{ old('custid',$white_list->custid) }}" id="custid" class="form-control">

                                    @if ($errors->has('custid'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('custid') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fundid') ? ' has-error' : '' }}">
                                <label for="fundid" class="col-md-3 control-label">资金帐号</label>

                                <div class="col-md-8">
                                    <input type="text" name="fundid" value="{{ old('fundid',$white_list->fundid) }}" id="fundid" class="form-control">

                                    @if ($errors->has('fundid'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fundid') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('max_connection') ? ' has-error' : '' }}">
                                <label for="max_connection" class="col-md-3 control-label">最大连接数</label>

                                <div class="col-md-8">
                                    <input type="text" name="max_connection" value="{{ old('max_connection',$white_list->max_connection) }}" id="max_connection" class="form-control">

                                    @if ($errors->has('max_connection'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('max_connection') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('bind_oms') ? ' has-error' : '' }}">
                                <label for="bind_oms" class="col-md-3 control-label">绑定的交易服务</label>

                                <div class="col-md-8">
                                    <select name="bind_oms" id="bind_oms" class="form-control select" >
                                        <option value="" > ---请选择--- </option>
                                        @foreach($trade_lists as $row)
                                            <option value="{{ $row->id }}" @if ($row->id==old('bind_oms',$white_list->bind_oms)) selected @endif>{{$row->server_name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('bind_oms'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('bind_oms') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('bind_quote') ? ' has-error' : '' }}">
                                <label for="bind_quote" class="col-md-3 control-label">绑定的行情服务</label>

                                <div class="col-md-8">
                                    <select name="bind_quote" id="bind_quote" class="form-control select" >
                                        <option value="" > ---请选择--- </option>
                                        @foreach($quote_lists as $row)
                                            <option value="{{ $row->id }}" @if ($row->id==old('bind_quote',$white_list->bind_quote)) selected @endif>{{$row->server_name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('bind_quote'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('bind_quote') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('trade_way_id') ? ' has-error' : '' }}">
                                <label for="trade_way_id" class="col-md-3 control-label">委托方式</label>

                                <div class="col-md-8">
                                    <select name="trade_way_id" id="trade_way_id" class="form-control select" >
                                        <option value="" > ---请选择--- </option>
                                        @foreach($tradeway_lists as $row)
                                            <option value="{{ $row->id }}" @if ($row->id==old('trade_way_id',$white_list->trade_way_id)) selected @endif>{{$row->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('trade_way_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('trade_way_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <input name="id" type="hidden" value="{{ old('id',$white_list->id) }}" />

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-save"></i> 保存
                                    </button>
                                    <a href="{{ URL('whitelist') }}" type="reset" class="btn btn-default">
                                        <i class="fa fa-btn fa-reply"></i> 取消
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