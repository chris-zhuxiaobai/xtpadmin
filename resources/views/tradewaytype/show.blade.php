@if ($title = "委托方式类型详情") @endif
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
                                <label for="type" class="col-md-3 control-label">类别</label>

                                <div class="col-md-8">
                                    <input type="text" id="type" value="{{ $tradewaytype->type == 1? '集中交易委托方式':'软件代码' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-md-3 control-label">名称</label>

                                <div class="col-md-8">
                                    <input type="text" id="name" value="{{ $tradewaytype->name or '' }}" class="form-control" readonly>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="trade_way" class="col-md-3 control-label">数值</label>

                                <div class="col-md-8">
                                    <input type="text" name="trade_way" value="{{ $tradewaytype->trade_way or '' }}" id="trade_way" class="form-control"  readonly>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="summary" class="col-md-3 control-label">备注</label>

                                <div class="col-md-8">
                                    <textarea id="summary" class="form-control"  readonly>{{ $tradewaytype->summary or '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-6">
                                    <a href="{{ URL('tradewaytype') }}" type="reset" class="btn btn-default">
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