@if ($title = "开户") @endif
@extends('layouts.app')

@section('content')
    <div class="container-fluid alert alert-success">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <div class="row">
            <div class="col-md-2 col-md-offset-5">
                <i class="fa fa-check fa-5x" aria-hidden="true"></i>
                开户成功!

            </div>
        </div>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <span class="col-md-12 col-md-offset-2">
                    {{$user->user_name}} 开户已完成, 将在下一个交易日生效。
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