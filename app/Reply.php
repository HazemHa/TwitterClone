<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    protected $table = 'replies';
    protected $primaryKey  = 'id';
    protected $fillable = ['body', 'user_id', 'tweet_id'];
    /**
     * Mass assignment guarded fields
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Relations
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tweet()
    {
        return $this->belongsTo(Reply::class);
    }
}
