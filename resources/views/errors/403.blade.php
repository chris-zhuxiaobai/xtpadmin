@if ($title = "403 没有权限") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        出错了
                    </div>
                    <div class="panel-body ">
                        <div class="col-md-12">
                            <div class="row">
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <div class="row">
                                    <div class="col-md-2 col-md-offset-5">


                                    </div>
                                </div>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-4">
                                            <span class="col-md-12 col-md-offset-2">
                                                {{$title}}
                                            </span>
                                    </div>

                                </div>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
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