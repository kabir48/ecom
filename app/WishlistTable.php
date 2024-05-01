<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishlistTable extends Model
{
    protected $table='wishlist_tables';
    protected $fillables=[
        'user_id',
        'wishlist_id',
        'status',
    ];

    public function products(){
        return $this->belongsTo(Product::class,'wishlist_id','id')->where('status',1);
    }
}
