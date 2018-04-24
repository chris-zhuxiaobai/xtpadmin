@if ($title = "销户") @endif
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
                                <label class="col-md-2 control-label">客户姓名</label>
                                <div class="col-md-3">
                                    <input type="text" value="{{ $user->preset->name or '' }}" class="form-control" readonly>
                                </div>

                                <label class="col-md-2 control-label">客户代码</label>
                                <div class="col-md-3">
                                    <input type="text" value="{{ $user->custid or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">XTP帐号</label>
                                <div class="col-md-3">
                                    <input type="text" value="{{ $user->user_name or '' }}" class="form-control" readonly>
                                </div>

                                <label class="col-md-2 control-label">资金帐号</label>
                                <div class="col-md-3">
                                    <input type="text" value="{{ $user->fundid or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">行情节点</label>
                                <div class="col-md-3">
                                    <input type="text" value="{{ $user->quoteServer->server_name or '' }}" class="form-control" readonly>
                                </div>

                                <label class="col-md-2 control-label">交易节点</label>
                                <div class="col-md-3">
                                    <input type="text" value="{{ $user->tradeServer->server_name or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            @if (!empty($user->secuInfo))
                                <div class="form-group">
                                    @foreach($user->secuInfo as $secu_info)
                                    <label class="col-md-2 control-label">{{$secu_info->market==0?'深交所股东帐号':($secu_info->market==1?'上交所股东帐号':$secu_info->market)}}</label>
                                    <div class="col-md-3">
                                        <input type="text" value="{{$secu_info->secu_acc or ''}}" class="form-control" readonly>
                                    </div>
                                    @endforeach
                                </div>
                             @endif

                        </form>
                    </div>

                    <div class="panel-heading">
                        <i class="fa fa-btn fa-user-times"></i>
                        {{$title}} - 上交所撤指定
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form">

                            <div class="form-group">
                                <div class="col-md-2 col-md-offset-2">
                                    <a href="javascript:void(0);" id="designation_sh" class="btn btn-warning" >
                                        上交所撤指定
                                    </a>
                                </div>

                                <div class="col-md-6">
                                    <div class="alert">
                                        <strong>
                                            <span class="alert-success" id="result_sh">
                                            </span>
                                        </strong>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="panel-heading">
                        <i class="fa fa-btn fa-user-times"></i>
                        {{$title}} - 深交所转托管
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-md-2 control-label">pbu id</label>
                                <div class="col-md-2">
                                    <input type="text" id="pbu_id" value="" class="form-control">
                                </div>

                                <div class="col-md-2">
                                    <a href="javascript:void(0);" id="designation_sz" class="btn btn-warning">
                                        深交所转托管
                                    </a>
                                </div>

                                <div class="col-md-6">
                                    <div class="alert">
                                        <strong>
                                            <span class="alert-success" id="result_sz">
                                            </span>
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('user/'.$user->id) }}">
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-2">
                                    <button id="btnDestroyUser" type="submit" class="btn btn-danger" disabled="disabled">
                                        下一步
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <script language="javascript">
                        setTimeout(function(){
                            $(document).ready(function(){
                                $('#designation_sh').click(function(){
                                    if ($(this).attr('disabled')) return;
                                    $('#result_sh').attr('class','').html('<i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading...</span>');
                                    $('#btnDestroyUser').attr('sh', 0);
                                    $.ajax({
                                        url: 'designation',
                                        dataType: "json",
                                        data: {user_id:'{{ $user->id or 0 }}', market:'sh'},
                                        type: 'GET',
                                        success:  function(result) {
                                            if (!result || result['error_code']){
                                                var html = '<i class="fa fa-close" aria-hidden="true"></i> 上交所撤指定执行失败: ';
                                                html += " [" + result['error_code'] + "] "+(result['error_msg']||'异常错误');
                                                $('#result_sh').attr('class','alert-danger').html(html);
                                            } else {
                                                var html = '<i class="fa fa-check" aria-hidden="true"></i> 上交所撤指定成功';
                                                $('#result_sh').attr('class','alert-success').html(html);
                                                $('#designation_sh').attr('disabled', 'disabled');
                                                $('#btnDestroyUser').attr('sh', 1);
                                                if ($('#btnDestroyUser').attr('sz')){
                                                    $('#btnDestroyUser').removeAttr('disabled');
                                                }
                                            }
                                        },
                                        error: function (http, type, text) {
                                            var html = '<i class="fa fa-close" aria-hidden="true"></i> 上交所撤指定执行失败: ';
                                            html += "请求失败, Err=(http code:" + http.status + ", msg:"+text+")";
                                            $('#result_sh').attr('class','alert-danger').html(html);
                                        }
                                    });
                                });

                                $('#designation_sz').click(function(){
                                    if ($(this).attr('disabled')) return;
                                    $('#result_sz').attr('class','').html('<i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading...</span>');
                                    $('#btnDestroyUser').attr('sz', 0);
                                    $.ajax({
                                        url: 'designation',
                                        dataType: "json",
                                        data: {user_id:'{{ $user->id or 0 }}', market:'sz', pbu_id: $('#pbu_id').val()},
                                        type: 'GET',
                                        success:  function(result) {
                                            if (!result || result['error_code']){
                                                var html = '<i class="fa fa-close" aria-hidden="true"></i> 深交所转托管执行失败: ';
                                                html += " [" + result['error_code'] + "] "+(result['error_msg']||'异常错误');
                                                $('#result_sz').attr('class','alert-danger').html(html);
                                            } else {
                                                var html = '<i class="fa fa-check" aria-hidden="true"></i> 深交所转托管成功';
                                                $('#result_sz').attr('class','alert-success').html(html);
                                                $('#designation_sz').attr('disabled', 'disabled');
                                                $('#btnDestroyUser').attr('sz', 1);
                                                if ($('#btnDestroyUser').attr('sh')){
                                                    $('#btnDestroyUser').removeAttr('disabled');
                                                }
                                            }
                                        },
                                        error: function (http, type, text) {
                                            var html = '<i class="fa fa-close" aria-hidden="true"></i> 深交所转托管执行失败: ';
                                            html += "请求失败, Err=(http code:" + http.status + ", msg:"+text+")";
                                            $('#result_sz').attr('class','alert-danger').html(html);
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