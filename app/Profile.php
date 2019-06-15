<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $primaryKey  = 'id';
    protected $fillable = ['bio', 'designation', 'company', 'city', 'country', 'dob', 'user_id'];
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
}
