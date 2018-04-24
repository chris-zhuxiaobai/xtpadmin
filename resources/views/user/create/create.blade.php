@if ($title = "开户") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-btn fa-user"></i>
                        客户信息
                    </div>

                    <div class="panel-body">

                        <form class="form-horizontal" role="form">

                            <div class="form-group">
                                <label class="col-md-2 control-label">营业部</label>
                                <div class="col-md-4">
                                    <input type="text" value="{{ $pre_user->org->orgname or '' }}" class="form-control" readonly>
                                </div>

                                <label class="col-md-2 control-label">客户姓名</label>
                                <div class="col-md-4">
                                    <input type="text" value="{{ $pre_user->name or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">客户代码</label>
                                <div class="col-md-4">
                                    <input type="text" value="{{ $pre_user->custid or '' }}" class="form-control" readonly>
                                </div>

                                <label class="col-md-2 control-label">资金帐号</label>
                                <div class="col-md-4">
                                    <input type="text" value="{{ $pre_user->fundid or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">行情节点</label>
                                <div class="col-md-4">
                                    <input type="text" value="{{ $pre_user->quote->server_name or '' }}" class="form-control" readonly>
                                </div>

                                <label class="col-md-2 control-label">交易节点</label>
                                <div class="col-md-4">
                                    <input type="text" value="{{ $pre_user->trade->server_name or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">客户委托方式</label>
                                <div class="col-md-4">
                                    <input type="text" value="{{ $pre_user->trade_way->name or '' }}" class="form-control" readonly>
                                </div>

                                <label class="col-md-2 control-label">客户端KEY</label>
                                <div class="col-md-4">
                                    <input type="text" value="{{ $pre_user->trade_way->key or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">上交所交易单元号</label>
                                <div class="col-md-4">
                                    <input type="text" value="{{ $oms_config->ogw_sh_config->pbu_id or '' }}" class="form-control" readonly>
                                </div>

                                <label class="col-md-2 control-label">深交所交易单元号</label>
                                <div class="col-md-4">
                                    <input type="text" value="{{ $oms_config->ogw_sz_config->pbu_id or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                        </form>

                    </div>


                    <div class="panel-heading">
                        <i class="fa fa-btn fa-user"></i>
                        {{$title}} - 上交所指定交易单元
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form">

                            <div class="form-group">
                                <div class="col-md-2 col-md-offset-2">
                                    <a href="javascript:void(0);" id="designation_sh_in" class="btn btn-warning" >
                                        上交所指定
                                    </a>
                                </div>

                                <div class="col-md-6">
                                    <div class="alert">
                                        <strong>
                                            <span class="alert-success" id="result_sh_in">
                                            </span>
                                        </strong>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="panel-heading">
                        设置XTP登录密码
                    </div>

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

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('user') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="pre_user_id" value="{{ $pre_user['id'] or 0 }}" />

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-2 control-label">密码</label>

                                <div class="col-md-5">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-2 control-label">密码确认</label>

                                <div class="col-md-5">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> 确定开户
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <script language="javascript">
                        setTimeout(function(){
                            $(document).ready(function(){
                                $('#designation_sh_in').click(function(){
                                    if ($(this).attr('disabled')) return;
                                    $('#result_sh_in').attr('class','').html('<i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading...</span>');
                                    $('#btnDestroyUser').attr('sh', 0);
                                    $.ajax({
                                        url: '{{ url('user/create/designation') }}',
                                        dataType: "json",
                                        data: {pre_user_id:'{{ $pre_user->id or 0 }}'},
                                        type: 'GET',
                                        success:  function(result) {
                                            if (!result || result['error_code']){
                                                var html = '<i class="fa fa-close" aria-hidden="true"></i> 上交所指定交易单元执行失败: ';
                                                html += " [" + result['error_code'] + "] "+(result['error_msg']||'异常错误');
                                                $('#result_sh_in').attr('class','alert-danger').html(html);
                                            } else {
                                                var html = '<i class="fa fa-check" aria-hidden="true"></i> 上交所指定交易单元成功';
                                                $('#result_sh_in').attr('class','alert-success').html(html);
                                                $('#designation_sh_in').attr('disabled', 'disabled');

                                            }
                                        },
                                        error: function (http, type, text) {
                                            var html = '<i class="fa fa-close" aria-hidden="true"></i> 上交所指定交易单元执行失败: ';
                                            html += "请求失败, Err=(http code:" + http.status + ", msg:"+text+")";
                                            $('#result_sh_in').attr('class','alert-danger').html(html);
                                        }
                                    });
                                });
                            });
                        }, 100) ;
                    </script>

                </div>
            </div>
        </div>
    </div>
@endsection