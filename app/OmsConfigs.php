<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OmsConfigs extends Model
{
    protected $table = "xtp_oms_config";

    public function oms()
    {
        return $this->belongsTo('App\Servers');
    }

    public function ogw_sh_config()
    {
        return $this->belongsTo('App\OgwConfigs', 'ogw_sh_id', 'ogw_id');
    }

    public function ogw_sz_config()
    {
        return $this->belongsTo('App\OgwConfigs', 'ogw_sz_id', 'ogw_id');
    }

    public function ogw_sh()
    {
        return $this->belongsTo('App\Servers');
    }

    public function ogw_sz()
    {
        return $this->belongsTo('App\Servers');
    }
}

