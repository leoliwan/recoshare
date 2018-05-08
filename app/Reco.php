<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DB;

class Reco extends Model
{
    use LikeTrait;
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function ratings()
    {
        return $this->morphMany('App\Rating', 'rateable');
    }

    // Rating Average
    public function getRatingAttribute()
    {
        return number_format(\DB::table('ratings')->where('rateable_id', $this->attributes['id'])->average('rating') * 1, 2);
    }


}
