<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
//PHP is a backend scripting language meant for dangerous scripting
//laravel is the most popular PHP framework for creating enormous applications