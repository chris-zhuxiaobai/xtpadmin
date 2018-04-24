<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OgwBranches extends Model
{
    protected $table = "xtp_ogw_branches";

    public function ogw()
    {
        return $this->belongsTo('App\Servers', 'xogw_id');
    }

    public function branche()
    {
        return $this->belongsTo('App\Branches', 'branch_prefix', 'prefix');
    }

}

