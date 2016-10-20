@if ($title = "股票限制详情") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" >

                            <div class="form-group">
                                <label class="col-md-3 control-label">ID</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $stocklimit->id or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">交易所</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $stocklimit->exch_id==1?'上交所':'深交所' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">股票代码</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $stocklimit->ticker or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">买入上下限</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $stocklimit->buy_qty_lower_limit or '' }}/{{ $stocklimit->buy_qty_upper_limit or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">卖出上下限</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $stocklimit->sell_qty_lower_limit or '' }}/{{ $stocklimit->sell_qty_upper_limit or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">起始日期</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $stocklimit->start_day or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">结束日期</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $stocklimit->end_day or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-6">
                                    <a href="{{ URL('stocklimit') }}" type="reset" class="btn btn-default">
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