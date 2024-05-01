<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
        public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

}
