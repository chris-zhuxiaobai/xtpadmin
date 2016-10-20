@if ($title = "交易节点信息配置编辑") @endif
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

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('omsconfig/'.$omsconfig->id) }}">
                            <input name="_method" type="hidden" value="PUT">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('oms_id') ? ' has-error' : '' }}">
                                <label for="oms_id" class="col-md-3 control-label">
                                    交易节点
                                </label>

                                <div class="col-md-8">
                                    <select name="oms_id" id="oms_id" class="form-control select" >
                                        <option value="" > ---请选择--- </option>
                                        @foreach($oms_lists as $row)
                                            <option value="{{$row->id}}" @if ($row->id==old('oms_id',$omsconfig->oms_id)) selected @endif>{{$row->server_name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('oms_id'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('oms_id') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ogw_sh_id') ? ' has-error' : '' }}">
                                <label for="ogw_sh_id" class="col-md-3 control-label">
                                    上交所报盘节点
                                </label>

                                <div class="col-md-8">
                                    <select name="ogw_sh_id" id="ogw_sh_id" class="form-control select" >
                                        <option value="" > ---请选择--- </option>
                                        @foreach($ogws_sh as $row)
                                            <option value="{{$row->id}}" @if ($row->id==old('ogw_sh_id',$omsconfig->ogw_sh_id)) selected @endif>{{$row->server_name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('ogw_sh_id'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('ogw_sh_id') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ogw_sz_id') ? ' has-error' : '' }}">
                                <label for="ogw_sz_id" class="col-md-3 control-label">
                                    深交所报盘节点
                                </label>

                                <div class="col-md-8">
                                    <select name="ogw_sz_id" id="ogw_sz_id" class="form-control select" >
                                        <option value="" > ---请选择--- </option>
                                        @foreach($ogws_sz as $row)
                                            <option value="{{$row->id}}" @if ($row->id==old('ogw_sz_id',$omsconfig->ogw_sz_id)) selected @endif>{{$row->server_name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('ogw_sz_id'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('ogw_sz_id') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-save"></i> 保存
                                    </button>
                                    <a href="{{ URL('omsconfig') }}" type="reset" class="btn btn-default">
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