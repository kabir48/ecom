<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFilterValue extends Model
{
    use HasFactory;
    
    public function filter(){
        return $this->belongsTo('App\ProductFilter','filter_id','id');
    }
   
}
