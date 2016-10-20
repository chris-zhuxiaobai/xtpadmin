@if ($title = "委托方式编辑") @endif
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

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('tradeway/'.$tradeway->id) }}">
                            <input name="_method" type="hidden" value="PUT">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">名称</label>

                                <div class="col-md-8">
                                    <input type="text" name="name" id="name" value="{{ old('name',$tradeway->name) }}" class="form-control">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            @foreach($tradeway_types as $type=>$rows)
                                @if ($type_id = 'type'.$type.'_id') @endif
                                <div class="form-group{{ $errors->has('type'.$type) ? ' has-error' : '' }}">
                                    <label for="type{{$type}}" class="col-md-3 control-label">
                                        @if ($type==1)
                                            集中交易委托方式
                                        @elseif ($type==2)
                                            软件代码
                                        @elseif ($type==3)
                                            软件版本前缀
                                        @endif
                                    </label>

                                    <div class="col-md-8">
                                        <select name="type{{$type}}" id="type{{$type}}" class="form-control select" >
                                            <option value="0" > ---请选择--- </option>
                                            @foreach($rows as $row)
                                                <option value="{{ old('id',$row->id) }}" @if ($row->id==$tradeway->$type_id) selected @endif>{{$row->name}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('type'.$type))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('type'.$type) }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group{{ $errors->has('summary') ? ' has-error' : '' }}">
                                <label for="summary" class="col-md-3 control-label">备注</label>

                                <div class="col-md-8">
                                    <textarea name="summary" id="summary" class="form-control">{{ $tradeway->summary}}</textarea>
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
                                    <a href="{{ URL('tradeway') }}" type="reset" class="btn btn-default">
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