<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TradeWayTypes;

class TradeWays extends Model
{
    protected $table = "xtp_trade_way";

    public function type1()
    {
        return $this->belongsTo('App\TradeWayTypes');
    }

    public function type2()
    {
        return $this->belongsTo('App\TradeWayTypes');
    }

    public function type3()
    {
        return $this->belongsTo('App\TradeWayTypes');
    }

}
