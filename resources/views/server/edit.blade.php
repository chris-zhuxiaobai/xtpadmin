@if ($title = "服务节点编辑") @endif
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

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('server/'.$server->id) }}">
                            <input name="_method" type="hidden" value="PUT">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('server_name') ? ' has-error' : '' }}">
                                <label for="server_name" class="col-md-3 control-label">服务节点名</label>

                                <div class="col-md-8">
                                    <input id="server_name" type="text" class="form-control" name="server_name" value="{{ old('server_name',$server->server_name) }}">

                                    @if ($errors->has('server_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('server_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('is_available') ? ' has-error' : '' }}">
                                <label for="server_name" class="col-md-3 control-label">是否可用</label>
                                <div class="col-md-8">
                                    <input id="is_available" type="checkbox" class="form-control" name="is_available" value="1" @if ($server->is_available) checked @endif>
                                    @if ($errors->has('is_available'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('is_available') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('max_connection') ? ' has-error' : '' }}">
                                <label for="max_connection" class="col-md-3 control-label">允许的最大连接数量</label>

                                <div class="col-md-8">
                                    <input id="max_connection" type="number" min="1" max="999" class="form-control" name="max_connection" value="{{ old('max_connection',$server->max_connection) }}">

                                    @if ($errors->has('max_connection'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('max_connection') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ip')||$errors->has('port') ? ' has-error' : '' }}">
                                <label for="ip" class="col-md-3 control-label">对外提供服务的地址</label>


                                <div class="col-md-1"><label for="ip" class="control-label">IP:</label></div>
                                <div class="col-md-4">
                                    <input id="ip" type="text" class="form-control" name="ip" value="{{ old('ip',$server->ip) }}">

                                    @if ($errors->has('ip'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('ip') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-1"><label for="port" class="control-label">端口:</label></div>
                                <div class="col-md-2">
                                    <input id="port" type="number" min="1" max="65535" class="form-control" name="port" value="{{ old('port',$server->port) }}">

                                    @if ($errors->has('port'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('port') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('status_type')||$errors->has('status_type2') ? ' has-error' : '' }}">
                                <label for="status_type" class="col-md-3 control-label">主/备</label>

                                <div class="col-md-1"><label for="status_type1" class=" control-label">主机:</label></div>
                                <div class="col-md-3">
                                    <input id="status_type1" type="radio" class="form-control radio" name="status_type" value="0" @if (old('status_type',$server->status_type)==0) checked @endif />
                                    @if ($errors->has('status_type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('status_type') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-1"><label for="status_type2" class=" control-label">备机:</label></div>
                                <div class="col-md-3">
                                    <input id="status_type2" type="radio" class="form-control radio" name="status_type" value="1" @if (old('status_type2',$server->status_type)!=0) checked @endif />

                                    @if ($errors->has('status_type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('status_type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('main_type') || $errors->has('sub_type') ? ' has-error' : '' }}">
                                <label for="main_type" class="col-md-3 control-label">服务端类型</label>

                                <div class="col-md-1"><label for="main_type" class=" control-label">主类型:</label></div>
                                <div class="col-md-3">
                                    <select name="main_type" id="main_type" class="form-control select" >
                                        <option value="-1" > ---请选择--- </option>
                                    </select>
                                    @if ($errors->has('main_type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('main_type') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-1"><label for="sub_type" class=" control-label">子类型:</label></div>
                                <div class="col-md-3">
                                    <select name="sub_type" id="sub_type" class="form-control select" >
                                        <option value="-1" > ---请选择--- </option>
                                    </select>
                                    @if ($errors->has('sub_type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sub_type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <script language="javascript">
                                var server_types = {!! json_encode($server_types) !!} ;
                                setTimeout(function(){
                                    $(document).ready(function(){
                                        var sel_main_type = $('#main_type');
                                        var sel_sub_type = $('#sub_type');

                                        sel_main_type.on('change', function(){
                                            sel_sub_type.empty();
                                            var m  = sel_main_type.val();
                                            for (var s in server_types[m]){
                                                var param = {
                                                    value: s,
                                                    text: server_types[m][s]['sub_type']
                                                };
                                                if ('{{ old('sub_type',$server->sub_type) }}' == s) {
                                                    param['selected'] = 'selected';
                                                }
                                                var option = $('<option/>', param).appendTo(sel_sub_type);
                                            }
                                        });

                                        for (var m in server_types){
                                            for (var s in server_types[m]){
                                                var param = {
                                                    value: m,
                                                    text: server_types[m][s]['main_type']
                                                };
                                                if ('{{ old('main_type',$server->main_type) }}' == m) {
                                                    param['selected'] = 'selected';
                                                }
                                                var option = $('<option/>', param).appendTo(sel_main_type);
                                                if ('{{ old('main_type',$server->main_type) }}' == m) {
                                                    sel_main_type.trigger('change');
                                                }
                                                break;
                                            }
                                        }
                                    });
                                }, 1);
                            </script>


                            <div class="form-group{{ $errors->has('server_summary') ? ' has-error' : '' }}">
                                <label for="server_summary" class="col-md-3 control-label">服务节点描述</label>

                                <div class="col-md-8">
                                    <textarea id="server_summary" class="form-control" name="server_summary">{{ old('server_summary',$server->server_summary) }}</textarea>

                                    @if ($errors->has('server_summary'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('server_summary') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <input name="id" type="hidden" value="{{ old('id',$server->id) }}" />

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-edit"></i> 修改
                                    </button>
                                    <a href="{{ URL('server') }}" type="reset" class="btn btn-default">
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