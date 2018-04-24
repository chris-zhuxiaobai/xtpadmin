<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OgwConfigs extends Model
{
    protected $table = "xtp_ogw_config";

    public function ogw()
    {
        return $this->belongsTo('App\Servers');
    }
}

