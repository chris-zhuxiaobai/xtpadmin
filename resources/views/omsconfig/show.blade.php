@if ($title = "交易节点信息配置详情") @endif
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
                                <label class="col-md-3 control-label">ID</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $omsconfig->id }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">交易节点</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $omsconfig->oms->server_name or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">上交所报盘节点</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $omsconfig->ogw_sh->server_name or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">深交所报盘节点</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $omsconfig->ogw_sz->server_name or '' }}" class="form-control" readonly>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-6">
                                    <a href="{{ URL('omsconfig') }}" type="reset" class="btn btn-default">
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