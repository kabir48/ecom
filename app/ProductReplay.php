<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReplay extends Model
{
      public function comments(){
        return $this->hasMany('App\ProductComment','comment_id');
    }
      public function admins(){
        return $this->belongsTo('App\Admin','user_id','id');
    }
}
