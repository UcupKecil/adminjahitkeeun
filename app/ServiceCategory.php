<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Berita;
class ServiceCategory extends Model
{
    protected $fillable=['name','photo'];

    public function post(){
        return $this->hasMany('App\Service','service_categories_id','id')->get();
    }

    public static function getBlogByCategory($slug){
        return ServiceCategory::with('post')->where('slug',$slug)->first();
    }
}
