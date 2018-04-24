<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branches extends Model
{
    protected $table = "xtp_branches";
    protected $perPage = 30;

    public function org()
    {
        return $this->belongsTo('App\Orgs', 'org_id', 'orgid');
    }
}
