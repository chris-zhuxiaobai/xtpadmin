@if ($title = "上交所报盘节点编辑") @endif
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

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('ogwbranche/'.$ogwbranche->id) }}">
                            <input name="_method" type="hidden" value="PUT">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('ogw_id') ? ' has-error' : '' }}">
                                <label for="ogw_id" class="col-md-3 control-label">
                                    上交所报盘节点
                                </label>

                                <div class="col-md-8">
                                    <select name="ogw_id" id="ogw_id" class="form-control select" >
                                        <option value="0" > ---请选择--- </option>
                                        @foreach($ogws as $row)
                                            <option value="{{ old('id',$row->id) }}" @if ($row->id==$ogwbranche->xogw_id) selected @endif>{{$row->server_name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('ogw_id'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('ogw_id') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('prefix') ? ' has-error' : '' }}">
                                <label for="prefix" class="col-md-3 control-label">合同号前缀</label>

                                <div class="col-md-8">
                                    <input id="prefix" type="text" class="form-control" name="prefix" value="{{ old('prefix',$ogwbranche->branch_prefix) }}" />

                                    @if ($errors->has('prefix'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('prefix') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('sno_start')||$errors->has('sno_end') ? ' has-error' : '' }}">
                                <label for="sno_start" class="col-md-3 control-label">合同号范围</label>

                                <label for="sno_start" class="col-md-1 control-label">起始:</label>
                                <div class="col-md-2">
                                    <input id="sno_start" name="sno_start" type="text" class="form-control"  value="{{ old('sno_start',$ogwbranche->sno_start) }}" />

                                    @if ($errors->has('sno_start'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sno_start') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <label for="sno_end" class="col-md-1 control-label">结束:</label>
                                <div class="col-md-2">
                                    <input id="sno_end" name="sno_end" type="text" class="form-control"  value="{{ old('sno_end',$ogwbranche->sno_end) }}" />

                                    @if ($errors->has('sno_end'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sno_end') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <label for="is_whole" class="col-md-1 control-label">全部:</label>
                                <div class="col-md-1">
                                    <input id="is_whole" name="is_whole" type="checkbox" @if (old('is_whole',$ogwbranche->is_whole)) checked @endif class="form-control"  value="1" />

                                    @if ($errors->has('is_whole'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('is_whole') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-save"></i> 保存
                                    </button>
                                    <a href="{{ URL('ogwbranche') }}" type="reset" class="btn btn-default">
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