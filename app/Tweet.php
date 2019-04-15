<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cog\Contracts\Love\Reacterable\Models\Reacterable as ReacterableContract;
use Cog\Laravel\Love\Reacterable\Models\Traits\Reacterable;
class Tweet extends Model implements ReacterableContract
{
    use Reacterable;

    protected $table = 'tweets';
    protected $primaryKey  = 'id';
    protected $fillable = ['body', 'user_id'];
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

    public function replies()
    {
        return $this->hasMany(Reply::class)->with('user')->latest();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
