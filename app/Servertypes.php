<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerTypes extends Model
{
    protected $table = "xtp_server_type";

    public static function getMap()
    {
        $st = ServerTypes::query()->get();

        $map = [];
        foreach ($st as $row){
            $map[$row['main_type']][$row['sub_type']] = [
                'main_type' => $row['main_type_str'],
                'sub_type'  => $row['sub_type_str']
            ];
        }

        return $map;
    }
}