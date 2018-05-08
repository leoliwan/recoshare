<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
   public function rateable()
   {
       return $this->morphTo();
   }

   public function user()
   {
       return $this->belongsTo('App\User');
   }

  
}
