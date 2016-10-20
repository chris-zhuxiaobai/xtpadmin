@if ($title = "报盘节点信息配置编辑") @endif
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

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('ogwconfig/'.$ogwconfig->id) }}">
                            <input name="_method" type="hidden" value="PUT">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('ogw_id') ? ' has-error' : '' }}">
                                <label for="ogw_id" class="col-md-3 control-label">
                                    报盘节点
                                </label>

                                <div class="col-md-8">
                                    <select name="ogw_id" id="ogw_id" class="form-control select" >
                                        <option value="" > ---请选择--- </option>
                                        @foreach($ogw_lists as $row)
                                            <option value="{{$row->id}}" @if ($row->id==$ogwconfig->ogw_id) selected @endif>[{{$row->sub_type==0?'上交所':'深交所'}}]{{$row->server_name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('ogw_id'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('ogw_id') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('pbu_id') ? ' has-error' : '' }}">
                                <label for="pbu_id" class="col-md-3 control-label">pbu id</label>

                                <div class="col-md-8">
                                    <input id="pbu_id" type="text" class="form-control" name="pbu_id" value="{{$ogwconfig->pbu_id}}" />

                                    @if ($errors->has('prefix'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('prefix') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-save"></i> 保存
                                    </button>
                                    <a href="{{ URL('ogwconfig') }}" type="reset" class="btn btn-default">
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