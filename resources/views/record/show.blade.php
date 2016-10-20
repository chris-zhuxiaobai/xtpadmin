@if ($title = "委托记录流水详情") @endif
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" >
                            <div class="form-group">
                                <label class="col-md-3 control-label">ID</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->id }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">RecNo</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->RecNo }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">NodeID</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->NodeID }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">ServerID</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->ServerID }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">UserID</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->UserID }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">UserName</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->UserName }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">CancelFlag</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->CancelFlag }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">XTPID</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->XTPID }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">ExchOrderID</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->ExchOrderID }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">OrderID</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->OrderID }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">BatchID</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->BatchID }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">OrderDate</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->OrderDate }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">OperTime</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->OperTime }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">ClientID</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->ClientID }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">ClientName</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->ClientName }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">BranchID</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->BranchID }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">FundAcc</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->FundAcc }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">CurType</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->CurType }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">SecuAcc</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->SecuAcc }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Market</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->Market }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Seat</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->Seat }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">StockCode</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->StockCode }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">StockName</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->StockName }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">StockType</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->StockType }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">OrderPrice</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->OrderPrice }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">OrderQty</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->OrderQty }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">TnvrQty</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->TnvrQty }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">CancelQty</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->CancelQty }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">ReptQty</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->ReptQty }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">TnvrAmt</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->TnvrAmt }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">BSFlag</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->BSFlag }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">ReptDate</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->ReptDate }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">ReptTime</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->ReptTime }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Status</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->Status }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Station</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->Station }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">TradeWay</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->TradeWay }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">CreditFlag</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->CreditFlag }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">CshGrpType</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->CshGrpType }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">CompactID</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->CompactID }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">SeqNo</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->SeqNo }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">OrdFrzAmt</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->OrdFrzAmt }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">OriOrderID</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->OriOrderID }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">OriBSFlag</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->OriBSFlag }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">OrdStatus</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->OrdStatus }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">TnvrTime</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->TnvrTime }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">ClientInfo</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->ClientInfo }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">WithholdPrice</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->WithholdPrice }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">WithholdAmount</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->WithholdAmount }}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">WithholdFee</label>

                                <div class="col-md-8">
                                    <input type="text" value="{{ $record->WithholdFee }}" class="form-control" readonly>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-6">
                                    <a href="{{ URL('record') }}" type="reset" class="btn btn-default">
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