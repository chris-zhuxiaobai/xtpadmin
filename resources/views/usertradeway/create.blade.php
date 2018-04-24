@if ($title = "客户委托方式新增") @endif
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

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('usertradeway') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                                <label for="user_name" class="col-md-3 control-label">XTP帐号</label>

                                <div class="col-md-8">
                                    <input type="text" name="user_name" id="user_name" value="{{ old('user_name')}}" class="form-control">

                                    @if ($errors->has('user_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('trade_way_id') ? ' has-error' : '' }}">
                                <label for="trade_way_id" class="col-md-3 control-label">委托方式</label>

                                <div class="col-md-8">
                                    <select name="trade_way_id" id="trade_way_id" class="form-control select" >
                                        <option value="" > ---请选择--- </option>
                                        @foreach($tradeway_lists as $row)
                                            <option value="{{$row->id}}" title="{{$row->summary}}" @if ($row->id==old('trade_way_id')) selected @endif>{{$row->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('trade_way_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('trade_way_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-save"></i> 保存
                                    </button>
                                    <a href="{{ URL('usertradeway') }}" type="reset" class="btn btn-default">
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