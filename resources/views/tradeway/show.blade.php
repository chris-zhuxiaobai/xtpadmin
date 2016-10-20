@if ($title = "委托方式详情") @endif
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
                                    <input type="text" value="{{ $tradeway->id }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">名称</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $tradeway->name }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">委托方式</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $tradeway->type1->name }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">软件代码</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $tradeway->type2->name }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">软件版本前缀</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $tradeway->type3->name }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">KEY</label>

                                <div class="col-md-8">
                                    <textarea class="form-control" readonly>{{ $tradeway->key }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">描述</label>

                                <div class="col-md-8">
                                    <textarea class="form-control" readonly>{{ $tradeway->summary }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-6">
                                    <a href="{{ URL('tradeway') }}" type="reset" class="btn btn-default">
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