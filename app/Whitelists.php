<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Whitelists extends Model
{
    protected $table = "xtp_white_list";

    public function org()
    {
        return $this->belongsTo('App\Orgs', 'orgid', 'orgid');
    }

    public function trade()
    {
        return $this->belongsTo('App\Servers', 'bind_oms');
    }

    public function quote()
    {
        return $this->belongsTo('App\Servers', 'bind_quote');
    }

    public function trade_way()
    {
        return $this->belongsTo('App\TradeWays');
    }
}
