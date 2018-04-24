@if ($title = "委托方式类型新增") @endif
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

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('tradewaytype') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-3 control-label">类别</label>

                                <div class="col-md-8">
                                    <select name="type" id="type" class="form-control select" >
                                        <option value="0" > ---请选择--- </option>
                                        <option value="1" @if (old('type')==1) selected @endif> 集中交易委托方式 </option>
                                        <option value="2" @if (old('type')==2) selected @endif> 软件代码 </option>
                                        <option value="3" @if (old('type')==3) selected @endif> 软件版本前缀 </option>
                                    </select>

                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">名称</label>

                                <div class="col-md-8">
                                    <input type="text" name="name" id="name" value="{{ old('name')}}" class="form-control">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                                <label for="trade_way" class="col-md-3 control-label">数值</label>

                                <div class="col-md-8">
                                    <input type="text" name="value" value="{{ old('value')}}" id="value" class="form-control">

                                    {{--<span class="help-block" id="type-2-help">--}}
                                        {{--<strong>注:  软件代码规划如下（以公司规划文档为准）：--}}
                                        {{--<div>（1）固定长度为2位；</div>--}}
                                        {{--<div>（2）第一位代表软件开发商: </div>--}}
                                        {{--<div style="padding-left: 25px;">0: 中泰证券自主研发 </div>--}}
                                        {{--<div style="padding-left: 25px;">1: 同花顺</div>--}}
                                        {{--<div style="padding-left: 25px;">2: 通达信</div>--}}
                                        {{--<div style="padding-left: 25px;">Z: 其他开发商 </div>--}}
                                        {{--</strong>--}}
                                    {{--</span>--}}

                                    @if ($errors->has('value'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('summary') ? ' has-error' : '' }}">
                                <label for="summary" class="col-md-3 control-label">描述</label>

                                <div class="col-md-8">
                                    <textarea name="summary" id="summary" class="form-control">{{ old('summary')}}</textarea>
                                    @if ($errors->has('summary'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('summary') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-save"></i> 保存
                                    </button>
                                    <a href="{{ URL('tradewaytype') }}" type="reset" class="btn btn-default">
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