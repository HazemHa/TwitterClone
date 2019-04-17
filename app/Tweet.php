<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;
use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;
class Tweet extends Model implements LikeableContract
{
    use Likeable;

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


}
