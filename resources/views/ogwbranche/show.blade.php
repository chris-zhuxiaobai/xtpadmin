@if ($title = "上交所报盘节点详情") @endif
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
                                    <input type="text" value="{{ $ogwbranche->id }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">营业部</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $ogwbranche->ogw->server_name or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">合同号前缀</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $ogwbranche->branch_prefix or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">范围</label>

                                <div class="col-md-8">
                                    <input type="text" value="@if ($ogwbranche->is_whole)全部 @else {{ $ogwbranche->sno_start }} - {{ $ogwbranche->sno_end }}
                                    @endif" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-6">
                                    <a href="{{ URL('ogwbranche') }}" type="reset" class="btn btn-default">
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