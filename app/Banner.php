<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
//ata korle amra sovai place static data use korte parvo ar ata use korte hobe model e
    public static function getBanners(){
        $getBanners=Banner::where('status',1)->get()->toArray();
        //$getBanners=$getBanners->sortBy('sort');
        // dd($getBanners);die;
        return $getBanners;
    }
}
