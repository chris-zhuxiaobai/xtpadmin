<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = "xtp_user";

    public function tradeways()
    {
        return $this->hasMany('App\UserTradeWays', 'user_id');
    }

    public function quoteServer()
    {
        return $this->belongsTo('App\Servers', 'quote_server_id');
    }

    public function tradeServer()
    {
        return $this->belongsTo('App\Servers', 'trade_server_id');
    }

    public function userType()
    {
        return $this->hasMany('App\ServerTypes', 'sub_type', 'user_type');
    }

    public function secuInfo()
    {
        return $this->hasMany('App\SecuInfo', 'client_id', 'custid');
    }

    public function preset()
    {
        return $this->belongsTo('App\Whitelists', 'fundid', 'fundid');
    }
}
