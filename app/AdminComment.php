<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminComment extends Model
{
    protected $table='admin_comments';

    public function comments()
    {
        return $this->belongsTo('App\AdminComment','info_id');
    }

}
