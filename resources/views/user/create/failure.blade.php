@if ($title = "开户") @endif
@extends('layouts.app')

@section('content')
    <div class="container-fluid alert alert-danger">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <div class="row">
            <div class="col-md-2 col-md-offset-5">
                <i class="fa fa-close fa-5x" aria-hidden="true"></i>
                开户失败!

            </div>
        </div>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <span class="col-md-12 col-md-offset-2">
                    请联系管理人员以取得更多信息。
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