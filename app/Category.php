<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  // metto post al plurale perché le categorie possono riferirsi a più post
  public function posts(){
    return $this->hasMany('App\Post');
  }
}
