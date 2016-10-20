@if ($title = "开户") @endif
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

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('user/create/choice') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('fundid') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">客户资金帐号</label>

                                <div class="col-md-8">
                                    <input id="fundid" type="text" class="form-control" name="fundid" value="{{old('fundid')}}" >

                                    @if ($errors->has('fundid'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fundid') }}</strong>
                                    </span>
                                    @endif
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