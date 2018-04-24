@if ($title=empty($page_title)?'后台管理':$page_title.' - 后台管理') @endif
@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <span><a href="{{ url('admin/product') }}" role="button" class="btn btn-default"><i class="fa fa-btn fa-bitbucket"></i> 产品管理</a></span>
                        <span><a href="{{ url('admin/package') }}" role="button" class="btn btn-default"><i class="fa fa-btn fa-gift"></i> 规格管理</a></span>
                        <span class="divider"></span>
                        <span><a href="{{ url('admin/stock') }}" role="button" class="btn btn-default"><i class="fa fa-btn fa-truck"></i> 库存管理</a></span>
                        <span><a href="{{ url('admin/stockassign') }}" role="button" class="btn btn-default"><i class="fa fa-btn fa-ambulance"></i> 库存分配管理</a></span>
                        <span class="divider"></span>
                        <span><a href="{{ url('admin/user') }}" role="button" class="btn btn-default"><i class="fa fa-btn fa-user"></i> 用户管理</a></span>
                        <span><a href="{{ url('admin/userrole') }}" role="button" class="btn btn-default"><i class="fa fa-btn fa-users"></i> 用户组管理</a></span>
                        <span class="divider"></span>
                        <span><a href="{{ url('admin/order') }}" role="button" class="btn btn-default"><i class="fa fa-btn fa-shopping-basket"></i> 订单管理</a></span>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">@if (!empty($page_title)) {{$page_title}} @endif</div>

                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-4 ">
                                <a href="{{ URL("admin/$page_name/create") }}" class="btn btn-success"><i
                                            class="fa fa-btn fa-plus-square"></i> 添加</a>

                            </div>
                        </div>
                    </div>

                    @yield('table')
                </div>

                {!! $rows->render() !!}
            </div>
        </div>
    </div>
@endsection