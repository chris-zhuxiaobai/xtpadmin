<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Schema;

class SecuInfo extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $table_ = 'xtp_secu_info_';
        $time = time();
        $max_try_num = 15;
        $try_num = 0;
        do {
            $date = date('Ymd', $time);
            $table = $table_ . $date;
            $time -= 86400;
        } while (!Schema::hasTable($table) && (++$try_num<$max_try_num));

        if ($try_num >= $max_try_num){
            $table = $table_ . 'template';
            $date = date('Ymd');
        }

        $this->table = $table;
        $this->date = $date;
    }

    public function user()
    {
        return $this->belongsTo('App\Users', 'custid', 'client_id');
    }

}