<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Users;
use App\TradeWays;

class UserTradeWays extends Model
{
    protected $table = "xtp_user_tradeway";

    public function user()
    {
        return $this->belongsTo('App\Users');
    }

    public function tradeway()
    {
        return $this->belongsTo('App\TradeWays');
    }
}
