@if ($title = "股票限制新增") @endif
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

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('stocklimit') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('exch_id') ? ' has-error' : '' }}">
                                <label for="exch_id" class="col-md-3 control-label">交易所</label>
                                <div class="col-md-8">
                                    <select name="exch_id" id="exch_id" class="form-control select" >
                                        <option value="" > ---请选择--- </option>
                                        <option value="1" @if (1==old('exch_id')) selected @endif>上交所</option>
                                        <option value="2" @if (2==old('exch_id')) selected @endif>深交所</option>
                                    </select>

                                    @if ($errors->has('exch_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('exch_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ticker') ? ' has-error' : '' }}">
                                <label for="ticker" class="col-md-3 control-label">股票代码</label>
                                <div class="col-md-8">
                                    <input type="text" name="ticker" id="ticker" class="form-control" value="{{ old('ticker')}}" />
                                    @if ($errors->has('ticker'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('ticker') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('buy_qty_lower_limit') || $errors->has('buy_qty_upper_limit') ? ' has-error' : '' }}">
                                <label for="main_type" class="col-md-3 control-label">买入限制</label>

                                <div class="col-md-1"><label for="buy_qty_lower_limit" class=" control-label">下限:</label></div>
                                <div class="col-md-2">
                                    <input type="text" name="buy_qty_lower_limit" id="buy_qty_lower_limit" class="form-control" value="{{ old('buy_qty_lower_limit', 0) }}" />
                                    @if ($errors->has('buy_qty_lower_limit'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('buy_qty_lower_limit') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-1"><label for="buy_qty_upper_limit" class=" control-label">上限:</label></div>
                                <div class="col-md-2">
                                    <input type="text" name="buy_qty_upper_limit" id="buy_qty_upper_limit" class="form-control" value="{{ old('buy_qty_upper_limit', 0)}}" />
                                    @if ($errors->has('buy_qty_upper_limit'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('buy_qty_upper_limit') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <label class="col-md-2 control-label">-1为不限制</label>
                            </div> 

                            <div class="form-group{{ $errors->has('sell_qty_lower_limit') || $errors->has('sell_qty_upper_limit') ? ' has-error' : '' }}">
                                <label for="main_type" class="col-md-3 control-label">卖出限制</label>

                                <div class="col-md-1"><label for="sell_qty_lower_limit" class=" control-label">下限:</label></div>
                                <div class="col-md-2">
                                    <input type="text" name="sell_qty_lower_limit" id="sell_qty_lower_limit" class="form-control" value="{{ old('sell_qty_lower_limit', -1)}}" />
                                    @if ($errors->has('sell_qty_lower_limit'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sell_qty_lower_limit') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-1"><label for="sell_qty_upper_limit" class=" control-label">上限:</label></div>
                                <div class="col-md-2">
                                    <input type="text" name="sell_qty_upper_limit" id="sell_qty_upper_limit" class="form-control" value="{{ old('sell_qty_upper_limit', -1)}}" />
                                    @if ($errors->has('sell_qty_upper_limit'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sell_qty_upper_limit') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-2 control-label">-1为不限制</label>
                            </div>


                            <div class="form-group{{ $errors->has('start_day') ? ' has-error' : '' }}">
                                <label for="start_day" class="col-md-3 control-label">起始日期</label>
                                <div class="col-md-8">
                                    <input type="date" name="start_day" id="start_day" class="form-control" value="{{ old('start_day', date('Y-m-d', strtotime('+1 day')))}}" />
                                    @if ($errors->has('start_day'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('start_day') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('end_day') ? ' has-error' : '' }}">
                                <label for="end_day" class="col-md-3 control-label">结束日期</label>
                                <div class="col-md-8">
                                    <input type="date" name="end_day" id="end_day" class="form-control" value="{{ old('end_day', date('Y-m-d', strtotime('+2 day')))}}" />
                                    @if ($errors->has('end_day'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('end_day') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-save"></i> 保存
                                    </button>
                                    <a href="{{ URL('stocklimit') }}" type="reset" class="btn btn-default">
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