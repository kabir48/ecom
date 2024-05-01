<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function categories(){
        return $this->hasMany('App\Model\Admin\Category','section_id')->where(['parent_id'=>'ROOT','status'=>1])->with('subcategories');
    }
    
    
    public static function sections(){
        $getSections =Section::with('categories')->where('status',1)->get();
        $getSections=json_decode(json_encode($getSections),true);
        return $getSections;

    }
     public static function sectionLadies(){
        $getSectionLady =Section::with('categoried')->where('status',1)->where('select_type','Ladystore')->get();
        $getSectionLady=json_decode(json_encode($getSectionLady),true);
        return $getSectionLady;

    }
    
    
    public function categoried(){
        
        return $this->hasMany('App\Model\Admin\Category','section_id')->where(['parent_id'=>'ROOT','status'=>1,'select_kinds'=>'Ladystore'])->with('subcategories');
    }
    
    
    public static function sectionDetails($url){
        $sectionDetails=Section::select('id','name','url')->where('url',$url)->first();
        $breadcumbs= '<a style="font-weight:600;color:#000">'.$sectionDetails['name'].'</a>';
        
        $sectionIds=array();
        $sectionIds[]=$sectionDetails['id'];
        //dd($catIds);die;
        return array('sectionIds'=>$sectionIds,'sectionDetails'=>$sectionDetails,'breadcumbs'=>$breadcumbs);
    }
}
