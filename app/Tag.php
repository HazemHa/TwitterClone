<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //

    protected $fillable = ['body','tweet_id'];

    public function tweets()
    {
        return $this->hasMany('App\Tweet','tag_id','id');
    }
}
