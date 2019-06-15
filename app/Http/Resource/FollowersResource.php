<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UsersResource;
use App\User;
class FollowersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  IlluminateHttpRequest  $request
     * @return array
     */
    public function toArray($request)
    {
        /* for one record

   return new FollowersResource(Followers::find($id));

 for multi records

return FollowersResource::collection(Followers::all());
 */
        return [
            'user_id' => $this->user_id,
            'follow_id' =>$this->follow_id,
            'user'=>new UsersResource(User::find($this->user_id)),
            'following'=>new UsersResource(User::find($this->follow_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
