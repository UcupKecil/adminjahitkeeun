<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Berita;
class AddressLabel extends Model
{
    protected $fillable=['name'];

    public function post(){
        return $this->hasMany('App\Address','addresslabel_id','id')->get();
    }

    public static function getBlogByCategory($slug){
        return AddressLabel::with('post')->where('slug',$slug)->first();
    }
}
