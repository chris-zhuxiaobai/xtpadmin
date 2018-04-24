@if ($title = "销户") @endif
@extends('layouts.app')

@section('content')
    <div class="container-fluid alert alert-success">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <div class="row">
            <div class="col-md-2 col-md-offset-5">
                <i class="fa fa-check fa-5x" aria-hidden="true"></i>
                销户成功!

            </div>
        </div>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <span class="col-md-12 col-md-offset-2">
                    {{$user->user_name}} 客户在XTP平台销户已完成, 请在主柜台系统进行后续操作。
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
@endsection