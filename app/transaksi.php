<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    //
    public function lokasi()
    {
        return $this->hasMany('App\lokasi');
    }
}
