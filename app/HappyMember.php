<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HappyMember extends Model
{
    public function users(){
        return $this->belongsTo('App\User','user_id');
    }
    public function product(){
        return $this->belongsTo('App\Product','product_one');
    }

}
