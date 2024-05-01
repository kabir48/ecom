<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
    use HasFactory;
    
    public function product(){
        return $this->belongsTo('App\Product','product_id','id');
    }
    
     public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
