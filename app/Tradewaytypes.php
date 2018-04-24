<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TradeWayTypes extends Model
{
    protected $table = "xtp_trade_way_type";

    public static function getMap()
    {
        $data = TradeWayTypes::query()->where('status', '=', 0)->get();

        $map = [];
        foreach ($data as $row){
            $map[$row['type']][] = $row;
        }

        return $map;
    }
}
