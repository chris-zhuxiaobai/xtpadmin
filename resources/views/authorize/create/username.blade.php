@if ($title = "授权") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-btn fa-user"></i>
                        {{$title}}
                    </div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="GET" action="{{ url('authorize/create/choice') }}">

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-3 control-label">请输入员工帐号:</label>

                                <div class="col-md-3">
                                    <input id="username" name="username" type="text" class="form-control" value="{{old('username')}}" >

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-5">
                                    <label class="control-label">@zts.com.cn</label>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-default">
                                        下一步
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection