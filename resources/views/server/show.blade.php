@if ($title = "服务节点详情") @endif
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
                                <label for="id" class="col-md-3 control-label">服务器ID</label>

                                <div class="col-md-8">
                                    <input class="form-control" value="{{ $server->id or '' }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="server_name" class="col-md-3 control-label">服务器名</label>

                                <div class="col-md-8">
                                    <input class="form-control" value="{{ $server->server_name or '' }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="server_name" class="col-md-3 control-label">是否可用</label>

                                <div class="col-md-2">
                                    @if($server->is_available)
                                        <span class="tag label label-success">
                                          <span>可用</span>
                                          <a><i class="fa fa-btn fa-check-square-o remove glyphicon glyphicon-remove-sign glyphicon-white"></i></a>
                                        </span>
                                    @else
                                        <span class="tag label label-danger">
                                          <span>不可用</span>
                                          <a><i class="fa fa-btn fa-remove remove glyphicon glyphicon-remove-sign glyphicon-white"></i></a>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="max_connection" class="col-md-3 control-label">允许的最大连接数量</label>

                                <div class="col-md-8">
                                    <input class="form-control" value="{{ $server->max_connection or '' }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ip" class="col-md-3 control-label">对外提供服务的地址</label>

                                <div class="col-md-1"><label for="ip" class="control-label">IP:</label></div>
                                <div class="col-md-4">
                                    <input class="form-control"value="{{ $server->ip or '' }}" readonly>

                                </div>
                                <div class="col-md-1"><label for="port" class="control-label">端口:</label></div>
                                <div class="col-md-2">
                                    <input class="form-control" value="{{ $server->port or '' }}" readonly>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="status_type" class="col-md-3 control-label">主/备</label>

                                <div class="col-md-8">
                                    <span class="tag label label-info">
                                      <span>
                                          @if($server->status_type==0)
                                              主机
                                          @else
                                              备机
                                          @endif
                                      </span>
                                      <a><i class="fa fa-btn fa-desktop remove glyphicon glyphicon-remove-sign glyphicon-white"></i></a>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="main_type" class="col-md-3 control-label">服务端类型</label>

                                <div class="col-md-1"><label for="main_type" class=" control-label">主类型:</label></div>
                                <div class="col-md-3">
                                    <input class="form-control" value="{{ $server_types[$server->main_type][$server->sub_type]['main_type'] or '' }}" readonly>
                                </div>

                                <div class="col-md-1"><label for="sub_type" class=" control-label">子类型:</label></div>
                                <div class="col-md-3">
                                    <input class="form-control" value="{{ $server_types[$server->main_type][$server->sub_type]['sub_type'] or '' }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="server_summary" class="col-md-3 control-label">服务器描述</label>

                                <div class="col-md-8">
                                    <textarea class="form-control" readonly>{{ $server->server_summary or '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-5">
                                    <a href="{{ URL('server') }}" type="reset" class="btn btn-primary">
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