<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableContract;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;
class Tweet extends Model implements ReactableContract
{
    use Reactable;

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
