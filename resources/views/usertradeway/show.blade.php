@if ($title = "客户委托方式详情") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form">

                            <div class="form-group">
                                <label class="col-md-3 control-label">ID</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $usertradeway->id or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">客户帐号</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $usertradeway->user->user_name or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">委托方式</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $usertradeway->tradeway->type1->name or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">软件代码</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $usertradeway->tradeway->type2->name or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">软件版本前缀</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $usertradeway->tradeway->type3->name or '' }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">KEY</label>

                                <div class="col-md-8">
                                    <textarea class="form-control" readonly>{{ $usertradeway->tradeway->key  or ''}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-6">
                                    <a href="{{ URL('usertradeway') }}" type="reset" class="btn btn-default">
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