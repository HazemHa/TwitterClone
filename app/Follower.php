<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $table = 'followers';
    protected $primaryKey  = 'id';
    protected $fillable = ['user_id','follow_id'];
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
        return $this->belongsTo(App\User::class);
    }
}
