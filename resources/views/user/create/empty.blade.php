@if ($title = "开户") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        <i class="fa fa-btn fa-user"></i>
                        {{$title}}
                    </div>
                    <div class="panel-body ">
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-5">
                                        <span class="col-md-10 col-md-offset-2">
                                            <i class="fa fa-warning fa-5x" aria-hidden="true"></i>
                                        </span>
                                        <p>&nbsp;</p>
                                        <span class="col-md-10 col-md-offset-1">
                                            暂时没有可开户的客户
                                        </span>
                                        <p>&nbsp;</p>
                                        <span class="col-md-12">
                                            请联系管理人员以取得更多信息。
                                        </span>
                                    </div>
                                </div>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection